const partners = [
  "CertainTeed",
  "James Hardie",
  "GAF",
  "Ply Gem",
  "Andersen",
  "Royal Building",
];

export default function Partners() {
  return (
    <section className="py-16 md:py-20 bg-white border-t border-gray-100">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Heading */}
        <div className="text-center mb-12">
          <span className="inline-block px-4 py-1.5 mb-4 text-xs font-semibold tracking-widest text-brand-700 uppercase bg-brand-50 rounded-full">
            Our Partners
          </span>
          <h2 className="text-3xl sm:text-4xl font-bold text-gray-900 tracking-tight">
            WE WORK WITH
          </h2>
        </div>

        {/* Logo grid */}
        <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
          {partners.map((partner) => (
            <div
              key={partner}
              className="flex items-center justify-center h-20 bg-gray-50 rounded-xl border border-gray-100 hover:border-brand-200 hover:bg-brand-50/50 transition-all duration-300"
            >
              <span className="text-sm font-bold text-gray-400 tracking-wide uppercase">
                {partner}
              </span>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
