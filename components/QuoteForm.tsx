"use client";

import { useState, FormEvent } from "react";
import { Send, CheckCircle, AlertCircle, Loader2 } from "lucide-react";

const SERVICES = [
  { value: "", label: "— Select a service —" },
  { value: "siding", label: "Siding" },
  { value: "roofing", label: "Roofing" },
  { value: "gutters", label: "Gutters" },
  { value: "windows_doors", label: "Windows / Doors" },
  { value: "exterior_paint_finish", label: "Exterior Paint / Finish" },
  { value: "other", label: "Other" },
];

const CONTACT_METHODS = ["Call", "Text", "Email"] as const;

interface FormData {
  fullName: string;
  phone: string;
  email: string;
  address: string;
  service: string;
  message: string;
  contactMethod: string;
  consent: boolean;
}

const initial: FormData = {
  fullName: "",
  phone: "",
  email: "",
  address: "",
  service: "",
  message: "",
  contactMethod: "",
  consent: false,
};

export default function QuoteForm() {
  const [form, setForm] = useState<FormData>(initial);
  const [status, setStatus] = useState<"idle" | "loading" | "success" | "error">("idle");
  const [errors, setErrors] = useState<string[]>([]);

  function set<K extends keyof FormData>(key: K, val: FormData[K]) {
    setForm((prev) => ({ ...prev, [key]: val }));
  }

  function validate(): string[] {
    const e: string[] = [];
    if (!form.fullName.trim()) e.push("Full Name is required.");
    if (!form.phone.trim()) e.push("Phone is required.");
    if (!form.email.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email))
      e.push("A valid email is required.");
    if (!form.service) e.push("Please select a service.");
    if (!form.message.trim()) e.push("Message is required.");
    if (!form.contactMethod) e.push("Please choose a preferred contact method.");
    if (!form.consent) e.push("You must consent before submitting.");
    return e;
  }

  async function handleSubmit(e: FormEvent) {
    e.preventDefault();
    const v = validate();
    if (v.length > 0) {
      setErrors(v);
      return;
    }
    setErrors([]);
    setStatus("loading");

    try {
      const res = await fetch("/api/inquiry", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(form),
      });
      if (!res.ok) {
        const data = await res.json().catch(() => null);
        throw new Error(data?.error || "Something went wrong.");
      }
      setStatus("success");
      setForm(initial);
    } catch (err) {
      setErrors([(err as Error).message]);
      setStatus("error");
    }
  }

  if (status === "success") {
    return (
      <section id="quote" className="py-20 md:py-28 bg-white">
        <div className="max-w-2xl mx-auto px-4 sm:px-6 text-center">
          <div className="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 mb-6">
            <CheckCircle className="w-8 h-8 text-green-600" />
          </div>
          <h2 className="text-2xl font-bold text-gray-900 mb-3">Thank You!</h2>
          <p className="text-gray-500">
            Your inquiry has been submitted. We&#39;ll be in touch shortly.
          </p>
          <button
            onClick={() => setStatus("idle")}
            className="mt-8 inline-flex items-center gap-2 px-7 py-3 text-sm font-semibold text-white bg-brand-700 rounded-full hover:bg-brand-800 transition-colors"
          >
            Submit Another Inquiry
          </button>
        </div>
      </section>
    );
  }

  return (
    <section id="quote" className="py-20 md:py-28 bg-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Header */}
        <div className="text-center max-w-2xl mx-auto mb-14">
          <span className="inline-block px-4 py-1.5 mb-4 text-xs font-semibold tracking-widest text-brand-700 uppercase bg-brand-50 rounded-full">
            Free Estimate
          </span>
          <h2 className="text-3xl sm:text-4xl font-bold text-gray-900 tracking-tight">
            GET A QUOTE
          </h2>
          <p className="mt-4 text-gray-500 leading-relaxed">
            Tell us about your project and we&#39;ll get back to you with a free,
            no-obligation estimate.
          </p>
        </div>

        {/* Form card */}
        <div className="max-w-2xl mx-auto">
          {errors.length > 0 && (
            <div className="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl" role="alert">
              <div className="flex items-center gap-2 mb-2">
                <AlertCircle className="w-5 h-5 text-red-600 flex-shrink-0" />
                <span className="text-sm font-semibold text-red-800">Please fix the following:</span>
              </div>
              <ul className="ml-7 list-disc space-y-1">
                {errors.map((err) => (
                  <li key={err} className="text-sm text-red-700">{err}</li>
                ))}
              </ul>
            </div>
          )}

          <form onSubmit={handleSubmit} noValidate className="space-y-5">
            {/* Honeypot */}
            <div className="absolute -left-[9999px] h-0 overflow-hidden" aria-hidden="true">
              <label htmlFor="website">Leave empty</label>
              <input type="text" id="website" name="website" tabIndex={-1} autoComplete="off" />
            </div>

            {/* Row: Name + Phone */}
            <div className="grid sm:grid-cols-2 gap-5">
              <div>
                <label htmlFor="fullName" className="block mb-1.5 text-sm font-semibold text-gray-900">
                  Full Name <span className="text-red-500">*</span>
                </label>
                <input
                  type="text"
                  id="fullName"
                  value={form.fullName}
                  onChange={(e) => set("fullName", e.target.value)}
                  required
                  className="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-700/20 focus:border-brand-700 transition-colors"
                />
              </div>
              <div>
                <label htmlFor="phone" className="block mb-1.5 text-sm font-semibold text-gray-900">
                  Phone <span className="text-red-500">*</span>
                </label>
                <input
                  type="tel"
                  id="phone"
                  value={form.phone}
                  onChange={(e) => set("phone", e.target.value)}
                  required
                  className="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-700/20 focus:border-brand-700 transition-colors"
                />
              </div>
            </div>

            {/* Row: Email + Address */}
            <div className="grid sm:grid-cols-2 gap-5">
              <div>
                <label htmlFor="email" className="block mb-1.5 text-sm font-semibold text-gray-900">
                  Email <span className="text-red-500">*</span>
                </label>
                <input
                  type="email"
                  id="email"
                  value={form.email}
                  onChange={(e) => set("email", e.target.value)}
                  required
                  className="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-700/20 focus:border-brand-700 transition-colors"
                />
              </div>
              <div>
                <label htmlFor="address" className="block mb-1.5 text-sm font-semibold text-gray-900">
                  Address / City
                </label>
                <input
                  type="text"
                  id="address"
                  value={form.address}
                  onChange={(e) => set("address", e.target.value)}
                  className="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-700/20 focus:border-brand-700 transition-colors"
                />
              </div>
            </div>

            {/* Service */}
            <div>
              <label htmlFor="service" className="block mb-1.5 text-sm font-semibold text-gray-900">
                Service Needed <span className="text-red-500">*</span>
              </label>
              <select
                id="service"
                value={form.service}
                onChange={(e) => set("service", e.target.value)}
                required
                className="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-brand-700/20 focus:border-brand-700 transition-colors"
              >
                {SERVICES.map((s) => (
                  <option key={s.value} value={s.value}>
                    {s.label}
                  </option>
                ))}
              </select>
            </div>

            {/* Message */}
            <div>
              <label htmlFor="message" className="block mb-1.5 text-sm font-semibold text-gray-900">
                Message <span className="text-red-500">*</span>
              </label>
              <textarea
                id="message"
                rows={5}
                value={form.message}
                onChange={(e) => set("message", e.target.value)}
                required
                className="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg resize-y focus:outline-none focus:ring-2 focus:ring-brand-700/20 focus:border-brand-700 transition-colors"
              />
            </div>

            {/* Contact method */}
            <fieldset>
              <legend className="block mb-2 text-sm font-semibold text-gray-900">
                Preferred Contact Method <span className="text-red-500">*</span>
              </legend>
              <div className="flex flex-wrap gap-5">
                {CONTACT_METHODS.map((method) => (
                  <label key={method} className="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                    <input
                      type="radio"
                      name="contactMethod"
                      value={method.toLowerCase()}
                      checked={form.contactMethod === method.toLowerCase()}
                      onChange={(e) => set("contactMethod", e.target.value)}
                      className="accent-brand-700"
                    />
                    {method}
                  </label>
                ))}
              </div>
            </fieldset>

            {/* Consent */}
            <label className="flex items-start gap-3 text-sm text-gray-500 cursor-pointer">
              <input
                type="checkbox"
                checked={form.consent}
                onChange={(e) => set("consent", e.target.checked)}
                required
                className="mt-0.5 accent-brand-700"
              />
              <span>
                I consent to Lawrence &amp; Sons storing my information and contacting
                me regarding this inquiry. <span className="text-red-500">*</span>
              </span>
            </label>

            {/* Submit */}
            <button
              type="submit"
              disabled={status === "loading"}
              className="inline-flex items-center gap-2 px-8 py-3.5 text-sm font-semibold text-white bg-brand-700 rounded-full hover:bg-brand-800 transition-colors disabled:opacity-60 disabled:cursor-not-allowed"
            >
              {status === "loading" ? (
                <>
                  <Loader2 className="w-4 h-4 animate-spin" />
                  Submitting…
                </>
              ) : (
                <>
                  <Send className="w-4 h-4" />
                  Submit Inquiry
                </>
              )}
            </button>
          </form>
        </div>
      </div>
    </section>
  );
}
