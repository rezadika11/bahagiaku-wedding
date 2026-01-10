<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';
import { ChevronLeft, ChevronRight } from 'lucide-vue-next';
import { computed } from 'vue';

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface Props {
    links: PaginationLink[];
}

const props = defineProps<Props>();

// Get only the page number links (exclude prev/next)
const pageLinks = computed(() => props.links.slice(1, -1));

// Smart pagination: show limited pages with ellipsis
const visiblePages = computed(() => {
    const pages = pageLinks.value;
    if (pages.length <= 7) return pages;

    const currentIndex = pages.findIndex((link) => link.active);
    const result: (PaginationLink | { label: string; isEllipsis: boolean })[] =
        [];

    // Always show first page
    result.push(pages[0]);

    // Show ellipsis if needed
    if (currentIndex > 3) {
        result.push({ label: '...', isEllipsis: true });
    }

    // Show pages around current
    const start = Math.max(1, currentIndex - 1);
    const end = Math.min(pages.length - 2, currentIndex + 1);

    for (let i = start; i <= end; i++) {
        result.push(pages[i]);
    }

    // Show ellipsis if needed
    if (currentIndex < pages.length - 4) {
        result.push({ label: '...', isEllipsis: true });
    }

    // Always show last page
    if (pages.length > 1) {
        result.push(pages[pages.length - 1]);
    }

    return result;
});
</script>

<template>
    <div
        v-if="links && links.length > 0"
        class="mt-4 flex items-center justify-center gap-1"
    >
        <!-- Previous Button -->
        <Link
            v-if="links[0]"
            :href="links[0].url || '#'"
            :class="{ 'pointer-events-none opacity-50': !links[0].url }"
        >
            <Button size="sm" variant="outline" :disabled="!links[0].url">
                <ChevronLeft class="h-4 w-4" />
            </Button>
        </Link>

        <!-- Page Numbers with Smart Ellipsis -->
        <template v-for="(item, index) in visiblePages" :key="index">
            <!-- Ellipsis -->
            <span
                v-if="'isEllipsis' in item && item.isEllipsis"
                class="px-3 py-1 text-sm text-gray-500"
            >
                ...
            </span>

            <!-- Page Link -->
            <Link
                v-else
                :href="(item as PaginationLink).url || '#'"
                :class="{
                    'pointer-events-none': !(item as PaginationLink).url,
                }"
            >
                <Button
                    size="sm"
                    :variant="
                        (item as PaginationLink).active ? 'default' : 'outline'
                    "
                    :disabled="!(item as PaginationLink).url"
                >
                    {{ (item as PaginationLink).label }}
                </Button>
            </Link>
        </template>

        <!-- Next Button -->
        <Link
            v-if="links[links.length - 1]"
            :href="links[links.length - 1].url || '#'"
            :class="{
                'pointer-events-none opacity-50': !links[links.length - 1].url,
            }"
        >
            <Button
                size="sm"
                variant="outline"
                :disabled="!links[links.length - 1].url"
            >
                <ChevronRight class="h-4 w-4" />
            </Button>
        </Link>
    </div>
</template>
