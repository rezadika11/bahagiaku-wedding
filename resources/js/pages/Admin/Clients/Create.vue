<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { Form, Head, Link } from '@inertiajs/vue3';

const breadcrumbs = [
    {
        title: 'Clients',
        href: '/admin/clients',
    },
    {
        title: 'Add Client',
        href: '',
    },
];
</script>

<template>
    <Head title="Add Client" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full max-w-2xl flex-col gap-6 p-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">Add New Client</h1>
                <Link href="/admin/clients">
                    <Button variant="outline">Back</Button>
                </Link>
            </div>

            <div
                class="rounded-xl border bg-card p-6 text-card-foreground shadow"
            >
                <Form action="/admin/clients" method="post" class="space-y-4">
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input
                            id="name"
                            name="name"
                            placeholder="e.g. Budi & Ani"
                            required
                        />
                    </div>

                    <div class="grid gap-2">
                        <Label for="phone">Phone Number (WA)</Label>
                        <Input
                            id="phone"
                            name="phone"
                            type="number"
                            placeholder="e.g. 08123456789"
                            required
                        />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">Email (Optional)</Label>
                        <Input
                            id="email"
                            name="email"
                            type="email"
                            placeholder="e.g. client@example.com"
                        />
                    </div>

                    <div class="grid gap-2">
                        <Label for="address">Address (Optional)</Label>
                        <textarea
                            id="address"
                            name="address"
                            class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:outline-none disabled:cursor-not-allowed disabled:opacity-50"
                            placeholder="Client address..."
                        ></textarea>
                    </div>

                    <div class="grid gap-2">
                        <Label for="notes">Notes (Internal)</Label>
                        <textarea
                            id="notes"
                            name="notes"
                            class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:outline-none disabled:cursor-not-allowed disabled:opacity-50"
                            placeholder="Internal notes..."
                        ></textarea>
                    </div>

                    <div class="flex justify-end pt-4">
                        <Button type="submit"> Save Client </Button>
                    </div>
                </Form>
            </div>
        </div>
    </AppLayout>
</template>
