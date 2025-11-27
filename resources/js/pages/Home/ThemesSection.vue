<template>
    <!-- Themes Section -->
    <section id="themes" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base text-teal-600 font-semibold tracking-wide uppercase">Tema Premium</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Desain Eksklusif untuk Momen Spesial
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Theme 1 -->
                <div class="group relative bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300">
                    <div class="aspect-[3/4] bg-gray-200 relative overflow-hidden">
                         <!-- Placeholder for theme image -->
                         <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10"></div>
                         <div class="absolute bottom-0 left-0 p-6 z-20 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform">
                            <h3 class="text-2xl font-bold mb-1">Rustic Teal</h3>
                            <p class="text-gray-200 text-sm opacity-0 group-hover:opacity-100 transition-opacity">Nuansa alam yang hangat dan elegan.</p>
                         </div>
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-30">
                        <button class="bg-white text-gray-900 px-6 py-2 rounded-full font-bold shadow-lg transform scale-90 group-hover:scale-100 transition-transform">Preview</button>
                    </div>
                </div>

                <!-- Theme 2 -->
                <div class="group relative bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300">
                    <div class="aspect-[3/4] bg-gray-200 relative overflow-hidden">
                         <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10"></div>
                         <div class="absolute bottom-0 left-0 p-6 z-20 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform">
                            <h3 class="text-2xl font-bold mb-1">Modern Minimalist</h3>
                            <p class="text-gray-200 text-sm opacity-0 group-hover:opacity-100 transition-opacity">Simpel, bersih, dan penuh makna.</p>
                         </div>
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-30">
                        <button class="bg-white text-gray-900 px-6 py-2 rounded-full font-bold shadow-lg transform scale-90 group-hover:scale-100 transition-transform">Preview</button>
                    </div>
                </div>

                <!-- Theme 3 -->
                <div class="group relative bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300">
                    <div class="aspect-[3/4] bg-gray-200 relative overflow-hidden">
                         <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10"></div>
                         <div class="absolute bottom-0 left-0 p-6 z-20 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform">
                            <h3 class="text-2xl font-bold mb-1">Floral Elegant</h3>
                            <p class="text-gray-200 text-sm opacity-0 group-hover:opacity-100 transition-opacity">Sentuhan bunga yang manis dan mewah.</p>
                         </div>
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-30">
                        <button class="bg-white text-gray-900 px-6 py-2 rounded-full font-bold shadow-lg transform scale-90 group-hover:scale-100 transition-transform">Preview</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
// No additional imports needed for this component
</script>