<script setup lang="ts">
import DatePicker from '@/components/DatePicker.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { Form, Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Theme {
    id: number;
    name: string;
}

interface Invitation {
    id: number;
    theme_id: number;
    groom_name: string;
    bride_name: string;
    wedding_date: string;
    slug: string;
    status: string;
}

const props = defineProps<{
    invitation: Invitation;
    themes: Theme[];
}>();

const breadcrumbs = [
    {
        title: 'Invitations',
        href: '/admin/invitations',
    },
    {
        title: props.invitation.slug,
        href: `/admin/invitations/${props.invitation.id}`,
    },
    {
        title: 'Edit',
        href: '',
    },
];

const weddingDate = ref(props.invitation.wedding_date);
</script>

<template>
    <Head title="Edit Invitation" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full max-w-3xl flex-col gap-6 p-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">Edit Invitation</h1>
                <Link href="/admin/invitations">
                    <Button variant="outline">Back</Button>
                </Link>
            </div>

            <div
                class="rounded-xl border bg-card p-6 text-card-foreground shadow"
            >
                <Form
                    :action="`/admin/invitations/${invitation.id}`"
                    method="put"
                    class="space-y-6"
                >
                    <!-- Couple Info -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="grid gap-2">
                            <Label for="groom_name">Groom Name</Label>
                            <Input
                                id="groom_name"
                                name="groom_name"
                                :model-value="invitation.groom_name"
                                required
                            />
                        </div>
                        <div class="grid gap-2">
                            <Label for="bride_name">Bride Name</Label>
                            <Input
                                id="bride_name"
                                name="bride_name"
                                :model-value="invitation.bride_name"
                                required
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <DatePicker
                            v-model="weddingDate"
                            label="Wedding Date"
                            name="wedding_date"
                            required
                        />
                        <div class="grid gap-2">
                            <Label for="slug">URL Slug</Label>
                            <div class="flex items-center">
                                <span
                                    class="rounded-l border border-r-0 bg-gray-100 px-3 py-2 text-sm text-gray-500"
                                    >/u/</span
                                >
                                <Input
                                    id="slug"
                                    name="slug"
                                    :model-value="invitation.slug"
                                    class="rounded-l-none"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-2">
                        <Label for="theme_id">Theme</Label>
                        <select
                            id="theme_id"
                            name="theme_id"
                            class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:outline-none disabled:cursor-not-allowed disabled:opacity-50"
                        >
                            <option
                                v-for="theme in themes"
                                :key="theme.id"
                                :value="theme.id"
                                :selected="theme.id === invitation.theme_id"
                            >
                                {{ theme.name }}
                            </option>
                        </select>
                    </div>

                    <div class="grid gap-2">
                        <Label for="status">Status</Label>
                        <select
                            id="status"
                            name="status"
                            class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:outline-none disabled:cursor-not-allowed disabled:opacity-50"
                        >
                            <option
                                value="draft"
                                :selected="invitation.status === 'draft'"
                            >
                                Draft
                            </option>
                            <option
                                value="published"
                                :selected="invitation.status === 'published'"
                            >
                                Published
                            </option>
                            <option
                                value="expired"
                                :selected="invitation.status === 'expired'"
                            >
                                Expired
                            </option>
                        </select>
                    </div>

                    <div class="flex justify-end pt-4">
                        <Button type="submit"> Update Invitation </Button>
                    </div>
                </Form>
            </div>
        </div>
    </AppLayout>
</template>
