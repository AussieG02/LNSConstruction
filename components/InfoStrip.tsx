import { DollarSign, ArrowRight } from "lucide-react";

export default function InfoStrip() {
  return (
    <section className="bg-brand-700">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div className="flex items-center gap-3">
          <div className="w-9 h-9 rounded-full bg-white/15 flex items-center justify-center flex-shrink-0">
            <DollarSign className="w-5 h-5 text-brand-200" />
          </div>
          <span className="text-sm font-semibold text-white tracking-wide uppercase">
            Cost of Exterior Renovation
          </span>
        </div>
        <a
          href="#quote"
          className="inline-flex items-center gap-2 px-5 py-2 text-xs font-semibold text-brand-700 bg-white rounded-full hover:bg-brand-50 transition-colors"
        >
          REQUEST A QUOTE
          <ArrowRight className="w-3.5 h-3.5" />
        </a>
      </div>
    </section>
  );
}
