<template>
    <!-- Testimonials Section -->
    <section id="testimonials" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base text-teal-600 font-semibold tracking-wide uppercase">Testimoni</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Apa Kata Mereka?
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Ribuan pasangan telah mempercayai kami untuk momen spesial mereka.
                </p>
            </div>

            <!-- Mobile: Single testimonial view -->
            <div class="md:hidden">
                <div class="relative">
                    <!-- Single testimonial container -->
                    <div class="overflow-hidden rounded-2xl">
                        <div
                            class="flex transition-transform duration-300 ease-in-out"
                            :style="{ transform: `translateX(-${currentTestimonialIndex * 100}%)` }"
                        >
                            <div
                                v-for="(testimonial, index) in testimonials"
                                :key="`mobile-${index}-${testimonial.name}`"
                                class="w-full flex-shrink-0"
                            >
                                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                                    <div class="flex items-center mb-4">
                                        <div class="flex text-yellow-400">
                                            <svg v-for="i in 5" :key="i" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 mb-6 italic">{{ testimonial.content }}</p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center text-teal-600 font-bold text-lg">{{ testimonial.initial }}</div>
                                        <div class="ml-4">
                                            <h4 class="font-bold text-gray-900">{{ testimonial.name }}</h4>
                                            <p class="text-sm text-gray-500">{{ testimonial.location }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile navigation dots (show all testimonials) -->
                    <div class="flex justify-center mt-4 space-x-2">
                        <button
                            v-for="(_, index) in testimonials"
                            :key="index"
                            @click="goToTestimonial(index)"
                            :class="['w-2 h-2 rounded-full transition-colors', currentTestimonialIndex === index ? 'bg-teal-600' : 'bg-gray-300']"
                            :aria-label="`Go to testimonial ${index + 1}`"
                        ></button>
                    </div>
                </div>
            </div>

            <!-- Desktop: 3 testimonials sliding carousel -->
            <div class="hidden md:block relative overflow-hidden">
                <div
                    class="flex transition-transform duration-500 ease-in-out"
                    :style="{ transform: `translateX(-${currentTestimonialIndex * 33.333}%)` }"
                >
                    <div
                        v-for="(testimonial, index) in [...testimonials, ...testimonials, ...testimonials]"
                        :key="`desktop-${index}-${testimonial.name}`"
                        class="w-full md:w-1/3 flex-shrink-0 px-4"
                    >
                        <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100 h-full">
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400">
                                    <svg v-for="i in 5" :key="i" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6 italic">{{ testimonial.content }}</p>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center text-teal-600 font-bold text-lg">{{ testimonial.initial }}</div>
                                <div class="ml-4">
                                    <h4 class="font-bold text-gray-900">{{ testimonial.name }}</h4>
                                    <p class="text-sm text-gray-500">{{ testimonial.location }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Desktop navigation dots (limited to 3) -->
                <div class="flex justify-center mt-6 space-x-2">
                    <button
                        v-for="(_, index) in 3"
                        :key="index"
                        @click="goToTestimonial(index)"
                        :class="['w-2 h-2 rounded-full transition-colors', currentTestimonialIndex === index ? 'bg-teal-600' : 'bg-gray-300']"
                        :aria-label="`Go to testimonial ${index + 1}`"
                    ></button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';

const currentTestimonialIndex = ref(0);

const testimonials = ref([
    {
        name: 'Andi & Sari',
        location: 'Jakarta',
        content: 'Undangan digitalnya sangat cantik dan mudah dibagikan! Semua tamu kami bisa langsung konfirmasi kehadiran. Sangat membantu!',
        initial: 'A'
    },
    {
        name: 'Budi & Dewi',
        location: 'Bandung',
        content: 'Harga terjangkau dengan hasil yang premium! Tema yang dipilih sangat sesuai dengan konsep pernikahan kami. Recommended!',
        initial: 'B'
    },
    {
        name: 'Rizki & Anisa',
        location: 'Surabaya',
        content: 'Pelayanan cepat dan responsif! Dalam hitungan jam undangan kami sudah jadi dan bisa langsung dibagikan. Terima kasih Bahagiaku!',
        initial: 'R'
    },
    {
        name: 'Fajar & Nina',
        location: 'Yogyakarta',
        content: 'Desain undangannya elegan dan modern. Tamu-tamu kami sangat terkesan dengan tampilannya. Terima kasih Bahagiaku!',
        initial: 'F'
    },
    {
        name: 'Maya & Doni',
        location: 'Semarang',
        content: 'Fitur RSVP-nya sangat membantu! Kami bisa tahu pasti berapa tamu yang hadir. Highly recommended!',
        initial: 'M'
    }
]);

const nextTestimonial = () => {
    currentTestimonialIndex.value = (currentTestimonialIndex.value + 1) % testimonials.value.length;
};

const prevTestimonial = () => {
    currentTestimonialIndex.value = currentTestimonialIndex.value === 0 ? testimonials.value.length - 1 : currentTestimonialIndex.value - 1;
};

const goToTestimonial = (index: number) => {
    currentTestimonialIndex.value = index;
};

let intervalId: number | null = null;

onMounted(() => {
    // Start auto-play on desktop
    intervalId = setInterval(nextTestimonial, 3000);
});

onUnmounted(() => {
    if (intervalId) {
        clearInterval(intervalId);
    }
});
</script>

<style scoped>
/* No additional styles needed - using Tailwind CSS classes */
</style>