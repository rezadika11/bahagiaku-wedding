<script setup lang="ts">
import DatePicker from '@/components/DatePicker.vue';
import SearchableSelect from '@/components/SearchableSelect.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { Form, Head, Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

interface Client {
    id: number;
    name: string;
}

interface Theme {
    id: number;
    name: string;
    thumbnail?: string;
}

const props = defineProps<{
    clients: Client[];
    themes: Theme[];
}>();

const selectedTheme = ref('');
const selectedClient = ref('');
const weddingDate = ref('');

const clientOptions = computed(() =>
    props.clients.map((client) => ({
        value: client.id,
        label: client.name,
    })),
);

const breadcrumbs = [
    {
        title: 'Invitations',
        href: '/admin/invitations',
    },
    {
        title: 'Create',
        href: '',
    },
];

// Auto-generate slug helper
const groomName = ref('');
const brideName = ref('');
const slug = ref('');

const generateSlug = () => {
    if (!slug.value && groomName.value && brideName.value) {
        slug.value = (groomName.value + '-' + brideName.value)
            .toLowerCase()
            .replace(/[^a-z0-9]/g, '-');
    }
};
</script>

<template>
    <Head title="Create Invitation" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full max-w-3xl flex-col gap-6 p-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">Create New Invitation</h1>
                <Link href="/admin/invitations">
                    <Button variant="outline">Back</Button>
                </Link>
            </div>

            <div
                class="rounded-xl border bg-card p-6 text-card-foreground shadow"
            >
                <Form
                    action="/admin/invitations"
                    method="post"
                    class="space-y-6"
                >
                    <!-- Client Selection with Search -->
                    <SearchableSelect
                        v-model="selectedClient"
                        :options="clientOptions"
                        label="Select Client"
                        name="client_id"
                        placeholder="Search and select client..."
                        required
                    />

                    <!-- Couple Info -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="grid gap-2">
                            <Label for="groom_name"
                                >Groom Name (Panggilan)</Label
                            >
                            <Input
                                id="groom_name"
                                name="groom_name"
                                v-model="groomName"
                                @input="generateSlug"
                                placeholder="e.g. Romeo"
                                required
                            />
                        </div>
                        <div class="grid gap-2">
                            <Label for="bride_name"
                                >Bride Name (Panggilan)</Label
                            >
                            <Input
                                id="bride_name"
                                name="bride_name"
                                v-model="brideName"
                                @input="generateSlug"
                                placeholder="e.g. Juliet"
                                required
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Wedding Date with VCalendar -->
                        <DatePicker
                            v-model="weddingDate"
                            label="Wedding Date"
                            name="wedding_date"
                            placeholder="Select wedding date"
                            required
                        />
                        <div class="grid gap-2">
                            <Label for="slug">URL Slug (unique)</Label>
                            <div class="flex items-center">
                                <span
                                    class="rounded-l border border-r-0 bg-gray-100 px-3 py-2 text-sm text-gray-500"
                                    >/u/</span
                                >
                                <Input
                                    id="slug"
                                    name="slug"
                                    v-model="slug"
                                    class="rounded-l-none"
                                    placeholder="romeo-juliet"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Theme Selection (Grid) -->
                    <div class="grid gap-2">
                        <Label>Select Theme</Label>
                        <div
                            class="grid max-h-[300px] grid-cols-2 gap-4 overflow-y-auto p-1 md:grid-cols-4"
                        >
                            <div
                                v-for="theme in themes"
                                :key="theme.id"
                                class="cursor-pointer rounded-lg border-2 p-2 transition-all hover:border-blue-500"
                                :class="{
                                    'border-blue-600 bg-blue-50':
                                        selectedTheme === String(theme.id),
                                    'border-gray-200':
                                        selectedTheme !== String(theme.id),
                                }"
                                @click="selectedTheme = String(theme.id)"
                            >
                                <input
                                    type="radio"
                                    name="theme_id"
                                    :value="theme.id"
                                    :checked="
                                        selectedTheme === String(theme.id)
                                    "
                                    class="hidden"
                                />
                                <div
                                    class="mb-2 aspect-[9/16] overflow-hidden rounded bg-gray-200"
                                >
                                    <img
                                        v-if="theme.thumbnail"
                                        :src="theme.thumbnail"
                                        class="h-full w-full object-cover"
                                    />
                                    <div
                                        v-else
                                        class="flex h-full items-center justify-center text-xs text-gray-400"
                                    >
                                        No Preview
                                    </div>
                                </div>
                                <div class="text-center text-sm font-medium">
                                    {{ theme.name }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <Button type="submit"> Create Invitation </Button>
                    </div>
                </Form>
            </div>
        </div>
    </AppLayout>
</template>
