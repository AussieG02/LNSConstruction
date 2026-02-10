import { ThumbsUp, Clock, HeartHandshake } from "lucide-react";

const reasons = [
  {
    icon: ThumbsUp,
    title: "Quality Craftsmanship",
    description:
      "Our skilled crews deliver precision exterior work using industry-leading techniques and manufacturer-certified installations.",
  },
  {
    icon: Clock,
    title: "On Time, On Budget",
    description:
      "We respect your time and investment. Every project includes a clear timeline and transparent pricing with no surprise costs.",
  },
  {
    icon: HeartHandshake,
    title: "Customer-First Approach",
    description:
      "From your first call to the final walkthrough, we communicate openly and ensure you're thrilled with the result.",
  },
];

export default function WhyChoose() {
  return (
    <section id="faq" className="py-20 md:py-28 bg-gray-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Heading */}
        <div className="text-center max-w-2xl mx-auto mb-14">
          <span className="inline-block px-4 py-1.5 mb-4 text-xs font-semibold tracking-widest text-brand-700 uppercase bg-brand-50 rounded-full">
            The Difference
          </span>
          <h2 className="text-3xl sm:text-4xl font-bold text-gray-900 tracking-tight">
            WHY CHOOSE LAWRENCE &amp; SONS
          </h2>
          <p className="mt-4 text-gray-500 leading-relaxed">
            Homeowners trust us because we combine old-school work ethic with
            modern materials and methods. Here&#39;s what sets us apart.
          </p>
        </div>

        {/* Reason cards */}
        <div className="grid md:grid-cols-3 gap-8">
          {reasons.map((reason) => (
            <div key={reason.title} className="text-center">
              <div className="w-16 h-16 mx-auto rounded-full bg-brand-700 flex items-center justify-center mb-6 shadow-lg shadow-brand-700/20">
                <reason.icon className="w-7 h-7 text-white" />
              </div>
              <h3 className="text-lg font-bold text-gray-900 mb-3">
                {reason.title}
              </h3>
              <p className="text-sm text-gray-500 leading-relaxed max-w-xs mx-auto">
                {reason.description}
              </p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
