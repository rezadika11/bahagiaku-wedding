<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { Form, Head, Link } from '@inertiajs/vue3';

interface Client {
    id: number;
    name: string;
    phone: string;
    email: string | null;
    address: string | null;
    notes: string | null;
}

const props = defineProps<{
    client: Client;
}>();

const breadcrumbs = [
    {
        title: 'Clients',
        href: '/admin/clients',
    },
    {
        title: props.client.name,
        href: `/admin/clients/${props.client.id}`,
    },
    {
        title: 'Edit',
        href: '',
    },
];
</script>

<template>
    <Head title="Edit Client" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full max-w-2xl flex-col gap-6 p-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">
                    Edit Client: {{ client.name }}
                </h1>
                <Link href="/admin/clients">
                    <Button variant="outline">Back</Button>
                </Link>
            </div>

            <div
                class="rounded-xl border bg-card p-6 text-card-foreground shadow"
            >
                <Form
                    :action="`/admin/clients/${client.id}`"
                    method="put"
                    class="space-y-4"
                >
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input
                            id="name"
                            name="name"
                            :model-value="client.name"
                            required
                        />
                    </div>

                    <div class="grid gap-2">
                        <Label for="phone">Phone Number (WA)</Label>
                        <Input
                            id="phone"
                            name="phone"
                            :model-value="client.phone"
                            required
                        />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">Email</Label>
                        <Input
                            id="email"
                            name="email"
                            type="email"
                            :model-value="client.email || ''"
                        />
                    </div>

                    <div class="grid gap-2">
                        <Label for="address">Address</Label>
                        <textarea
                            id="address"
                            name="address"
                            :value="client.address || ''"
                            class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:outline-none disabled:cursor-not-allowed disabled:opacity-50"
                        ></textarea>
                    </div>

                    <div class="grid gap-2">
                        <Label for="notes">Notes</Label>
                        <textarea
                            id="notes"
                            name="notes"
                            :value="client.notes || ''"
                            class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:outline-none disabled:cursor-not-allowed disabled:opacity-50"
                        ></textarea>
                    </div>

                    <div class="flex justify-end pt-4">
                        <Button type="submit"> Update Client </Button>
                    </div>
                </Form>
            </div>
        </div>
    </AppLayout>
</template>
