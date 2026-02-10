import { Layers, CloudRain, DoorOpen, ArrowRight } from "lucide-react";

const services = [
  {
    icon: Layers,
    title: "Siding & Exterior Cladding",
    description:
      "Upgrade your home's protection and appearance with premium vinyl, fiber cement, or engineered wood siding installed by certified professionals.",
  },
  {
    icon: CloudRain,
    title: "Roofing & Gutters",
    description:
      "From full roof replacements to seamless gutter systems, we safeguard your home against the elements with materials built to last.",
  },
  {
    icon: DoorOpen,
    title: "Windows, Doors & Exterior Finishes",
    description:
      "Boost energy efficiency and curb appeal with expertly installed windows, entry doors, and exterior trim and finish work.",
  },
];

export default function Services() {
  return (
    <section id="services" className="py-20 md:py-28 bg-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Heading */}
        <div className="text-center max-w-2xl mx-auto mb-14">
          <span className="inline-block px-4 py-1.5 mb-4 text-xs font-semibold tracking-widest text-brand-700 uppercase bg-brand-50 rounded-full">
            What We Do
          </span>
          <h2 className="text-3xl sm:text-4xl font-bold text-gray-900 tracking-tight">
            OUR SERVICES
          </h2>
          <p className="mt-4 text-gray-500 leading-relaxed">
            We specialize in exterior renovation services that protect your
            investment and elevate your home&#39;s appearance. Every project is backed
            by quality materials and expert workmanship.
          </p>
        </div>

        {/* Cards */}
        <div className="grid md:grid-cols-3 gap-6 lg:gap-8">
          {services.map((service) => (
            <div
              key={service.title}
              className="group relative bg-white border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-lg hover:border-brand-200 transition-all duration-300"
            >
              <div className="w-14 h-14 rounded-xl bg-brand-50 flex items-center justify-center mb-6 group-hover:bg-brand-700 transition-colors duration-300">
                <service.icon className="w-7 h-7 text-brand-700 group-hover:text-white transition-colors duration-300" />
              </div>
              <h3 className="text-lg font-bold text-gray-900 mb-3">
                {service.title}
              </h3>
              <p className="text-sm text-gray-500 leading-relaxed">
                {service.description}
              </p>
              <div className="mt-6 pt-5 border-t border-gray-100">
                <a
                  href="#quote"
                  className="inline-flex items-center gap-1.5 text-sm font-semibold text-brand-700 hover:text-brand-600 transition-colors"
                >
                  Learn More
                  <ArrowRight className="w-4 h-4" />
                </a>
              </div>
            </div>
          ))}
        </div>

        {/* CTA */}
        <div className="text-center mt-12">
          <a
            href="#services"
            className="inline-flex items-center gap-2 px-7 py-3.5 text-sm font-semibold text-white bg-brand-700 rounded-full hover:bg-brand-800 transition-colors"
          >
            VIEW ALL SERVICES
            <ArrowRight className="w-4 h-4" />
          </a>
        </div>
      </div>
    </section>
  );
}
