import { NextRequest, NextResponse } from "next/server";

/* ------------------------------------------------------------------ */
/*  Valid values (keep in sync with the front-end component)           */
/* ------------------------------------------------------------------ */
const VALID_SERVICES = [
  "siding",
  "roofing",
  "gutters",
  "windows_doors",
  "exterior_paint_finish",
  "other",
];
const VALID_CONTACT = ["call", "text", "email"];

const SERVICE_LABELS: Record<string, string> = {
  siding: "Siding",
  roofing: "Roofing",
  gutters: "Gutters",
  windows_doors: "Windows / Doors",
  exterior_paint_finish: "Exterior Paint / Finish",
  other: "Other",
};

/* ------------------------------------------------------------------ */
/*  POST handler                                                      */
/* ------------------------------------------------------------------ */
export async function POST(req: NextRequest) {
  try {
    const body = await req.json();

    const {
      fullName,
      phone,
      email,
      address,
      service,
      message,
      contactMethod,
      consent,
    } = body as {
      fullName: string;
      phone: string;
      email: string;
      address: string;
      service: string;
      message: string;
      contactMethod: string;
      consent: boolean;
    };

    /* ---------- Validation ---------- */
    const errors: string[] = [];

    if (!fullName?.trim()) errors.push("Full Name is required.");
    if (!phone?.trim()) errors.push("Phone is required.");
    if (!email?.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email))
      errors.push("A valid email is required.");
    if (!service || !VALID_SERVICES.includes(service))
      errors.push("Please select a valid service.");
    if (!message?.trim()) errors.push("Message is required.");
    if (!contactMethod || !VALID_CONTACT.includes(contactMethod))
      errors.push("Please choose a valid contact method.");
    if (!consent) errors.push("Consent is required.");

    if (errors.length > 0) {
      return NextResponse.json({ error: errors.join(" ") }, { status: 400 });
    }

    /* ---------- Send email via Resend (if configured) ---------- */
    const resendKey = process.env.RESEND_API_KEY;
    const notifyEmail = process.env.NOTIFY_EMAIL;

    if (resendKey && notifyEmail) {
      const serviceLabel = SERVICE_LABELS[service] ?? service;
      const date = new Date().toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
      });

      const text = [
        `New quote inquiry received on ${date}`,
        "",
        `Name:              ${fullName}`,
        `Phone:             ${phone}`,
        `Email:             ${email}`,
        `Address / City:    ${address || "—"}`,
        `Service Needed:    ${serviceLabel}`,
        `Preferred Contact: ${contactMethod}`,
        "",
        "Message:",
        message,
      ].join("\n");

      const html = `
        <div style="font-family:sans-serif;max-width:560px;margin:0 auto;">
          <h2 style="color:#1F4D3A;">New Quote Inquiry</h2>
          <p style="color:#666;font-size:14px;">${date}</p>
          <table style="width:100%;border-collapse:collapse;margin:16px 0;">
            <tr><td style="padding:8px 0;font-weight:600;color:#333;width:160px;">Name</td><td style="padding:8px 0;color:#555;">${fullName}</td></tr>
            <tr><td style="padding:8px 0;font-weight:600;color:#333;">Phone</td><td style="padding:8px 0;color:#555;">${phone}</td></tr>
            <tr><td style="padding:8px 0;font-weight:600;color:#333;">Email</td><td style="padding:8px 0;color:#555;">${email}</td></tr>
            <tr><td style="padding:8px 0;font-weight:600;color:#333;">Address / City</td><td style="padding:8px 0;color:#555;">${address || "—"}</td></tr>
            <tr><td style="padding:8px 0;font-weight:600;color:#333;">Service</td><td style="padding:8px 0;color:#555;">${serviceLabel}</td></tr>
            <tr><td style="padding:8px 0;font-weight:600;color:#333;">Contact via</td><td style="padding:8px 0;color:#555;">${contactMethod}</td></tr>
          </table>
          <p style="font-weight:600;color:#333;">Message:</p>
          <p style="color:#555;white-space:pre-wrap;">${message}</p>
        </div>
      `;

      await fetch("https://api.resend.com/emails", {
        method: "POST",
        headers: {
          Authorization: `Bearer ${resendKey}`,
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          from: process.env.RESEND_FROM || "Lawrence & Sons <quotes@lnsconstr.com>",
          to: [notifyEmail],
          subject: `[New Inquiry] ${fullName} – ${serviceLabel}`,
          text,
          html,
        }),
      });
    } else {
      /* No email provider configured — log to server console */
      console.log("--- NEW INQUIRY ---");
      console.log({ fullName, phone, email, address, service, message, contactMethod });
      console.log("-------------------");
      console.log(
        "To enable email notifications, set RESEND_API_KEY and NOTIFY_EMAIL in your environment variables."
      );
    }

    return NextResponse.json({ ok: true });
  } catch {
    return NextResponse.json(
      { error: "Internal server error. Please try again." },
      { status: 500 }
    );
  }
}
