import {
  Award,
  PackageCheck,
  ShieldCheck,
  BadgeCheck,
  Wrench,
  Sparkles,
} from "lucide-react";

const highlights = [
  {
    icon: Award,
    title: "Over 25 Years Experience",
    description: "Decades of proven expertise in exterior renovation projects across the whole Houston, TX.",
  },
  {
    icon: PackageCheck,
    title: "Best Materials",
    description: "We only use top-tier, manufacturer-certified products for lasting results.",
  },
  {
    icon: ShieldCheck,
    title: "Professional Standards",
    description: "Every job meets or exceeds industry codes and manufacturer specifications.",
  },
];

const features = [
  { icon: BadgeCheck, label: "Licensed & Insured" },
  { icon: Wrench, label: "Warranty-Backed Work" },
  { icon: Sparkles, label: "Clean Jobsite Promise" },
];

export default function About() {
  return (
    <section id="about" className="py-20 md:py-28 bg-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Heading */}
        <div className="text-center max-w-2xl mx-auto mb-14">
          <span className="inline-block px-4 py-1.5 mb-4 text-xs font-semibold tracking-widest text-brand-700 uppercase bg-brand-50 rounded-full">
            Who We Are
          </span>
          <h2 className="text-3xl sm:text-4xl font-bold text-gray-900 tracking-tight">
            ABOUT US
          </h2>
        </div>

        {/* Two-column */}
        <div className="grid lg:grid-cols-2 gap-12 lg:gap-16 items-start">
          {/* Left: description */}
          <div>
            <h3 className="text-2xl font-bold text-gray-900 mb-4">
              Your Trusted Exterior Renovation Partner
            </h3>
            <p className="text-gray-500 leading-relaxed mb-4">
              Lawrence &amp; Sons is a family-owned exterior renovation company
              with over 15 years of hands-on experience. We specialize in
              transforming homes with premium siding, roofing, windows, doors,
              and gutters — delivering results that protect your investment and
              enhance curb appeal.
            </p>
            <p className="text-gray-500 leading-relaxed">
              From the first consultation to the final walkthrough, our team is
              committed to transparent communication, meticulous workmanship, and
              leaving your property better than we found it. We treat every home
              like it&#39;s our own.
            </p>
          </div>

          {/* Right: highlight items */}
          <div className="space-y-6">
            {highlights.map((item) => (
              <div key={item.title} className="flex gap-4">
                <div className="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center flex-shrink-0">
                  <item.icon className="w-6 h-6 text-brand-700" />
                </div>
                <div>
                  <h4 className="font-bold text-gray-900">{item.title}</h4>
                  <p className="mt-1 text-sm text-gray-500 leading-relaxed">
                    {item.description}
                  </p>
                </div>
              </div>
            ))}
          </div>
        </div>

        {/* Feature tiles */}
        <div className="mt-14 grid sm:grid-cols-3 gap-4">
          {features.map((feature) => (
            <div
              key={feature.label}
              className="flex items-center gap-3 bg-brand-50 rounded-xl px-6 py-5"
            >
              <feature.icon className="w-6 h-6 text-brand-700 flex-shrink-0" />
              <span className="text-sm font-semibold text-brand-800">
                {feature.label}
              </span>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
