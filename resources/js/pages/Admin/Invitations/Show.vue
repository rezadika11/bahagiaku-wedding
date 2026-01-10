<script setup lang="ts">
import ConfirmDialog from '@/components/ConfirmDialog.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { Form, Head, Link, router } from '@inertiajs/vue3';
import axios from 'axios';
import { Trash2 } from 'lucide-vue-next';
import { ref } from 'vue';

// Interfaces
interface Guest {
    id: number;
    name: string;
    phone: string;
    guest_code: string;
    guest_group: string;
    quota: number;
    broadcasts?: any[];
}

interface Event {
    id: number;
    event_name: string;
    event_date: string;
    event_time_start: string;
    venue_name: string;
}

interface Invitation {
    id: number;
    slug: string;
    groom_name: string;
    bride_name: string;
    wedding_date: string;
    status: string;
    client: { id: number; name: string };
    theme: { id: number; name: string };
    events: Event[];
    guests: Guest[];
}

const props = defineProps<{
    invitation: Invitation;
}>();

const breadcrumbs = [
    { title: 'Invitations', href: '/admin/invitations' },
    { title: props.invitation.slug, href: '' },
];

const activeTab = ref('overview');

// --- Guest Management ---
// --- Guest Management ---
const showConfirmDialog = ref(false);
const guestToDeleteId = ref<number | null>(null);

const confirmDeleteGuest = (guestId: number) => {
    guestToDeleteId.value = guestId;
    showConfirmDialog.value = true;
};

const handleDeleteGuest = () => {
    if (guestToDeleteId.value) {
        router.delete(`/admin/guests/${guestToDeleteId.value}`, {
            onFinish: () => {
                showConfirmDialog.value = false;
                guestToDeleteId.value = null;
            },
        });
    }
};

const whatsappLoading = ref<number | null>(null);

const sendWhatsapp = async (guest: Guest) => {
    whatsappLoading.value = guest.id;
    try {
        const response = await axios.post(
            `/admin/guests/${guest.id}/broadcast`,
        );
        if (response.data.whatsapp_url) {
            window.open(response.data.whatsapp_url, '_blank');
            // Optimistically update UI or reload to show status
            router.reload({ only: ['invitation'] });
        }
    } catch (error) {
        alert('Failed to generate WhatsApp link');
        console.error(error);
    } finally {
        whatsappLoading.value = null;
    }
};
</script>

<template>
    <Head :title="invitation.slug" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-col gap-6 p-4">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">
                        {{ invitation.groom_name }} &
                        {{ invitation.bride_name }}
                    </h1>
                    <Link
                        :href="`/u/${invitation.slug}`"
                        target="_blank"
                        class="text-sm text-blue-600 hover:underline"
                    >
                        /u/{{ invitation.slug }}
                    </Link>
                </div>
                <div class="space-x-2">
                    <Link :href="`/admin/invitations/${invitation.id}/edit`">
                        <Button variant="outline">Edit Settings</Button>
                    </Link>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="flex border-b">
                <button
                    @click="activeTab = 'overview'"
                    class="border-b-2 px-4 py-2 text-sm font-medium"
                    :class="
                        activeTab === 'overview'
                            ? 'border-primary text-primary'
                            : 'border-transparent text-gray-500 hover:text-gray-700'
                    "
                >
                    Overview
                </button>
                <button
                    @click="activeTab = 'guests'"
                    class="border-b-2 px-4 py-2 text-sm font-medium"
                    :class="
                        activeTab === 'guests'
                            ? 'border-primary text-primary'
                            : 'border-transparent text-gray-500 hover:text-gray-700'
                    "
                >
                    Guests ({{ invitation.guests.length }})
                </button>
                <button
                    @click="activeTab = 'events'"
                    class="border-b-2 px-4 py-2 text-sm font-medium"
                    :class="
                        activeTab === 'events'
                            ? 'border-primary text-primary'
                            : 'border-transparent text-gray-500 hover:text-gray-700'
                    "
                >
                    Events
                </button>
            </div>

            <!-- TAB: OVERVIEW -->
            <div
                v-if="activeTab === 'overview'"
                class="grid gap-6 md:grid-cols-2"
            >
                <Card>
                    <CardHeader><CardTitle>Details</CardTitle></CardHeader>
                    <CardContent class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Status</span>
                            <Badge>{{ invitation.status }}</Badge>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Wedding Date</span>
                            <span>{{
                                new Date(
                                    invitation.wedding_date,
                                ).toLocaleDateString()
                            }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Theme</span>
                            <span>{{ invitation.theme?.name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Client</span>
                            <Link
                                :href="`/admin/clients/${invitation.client.id}`"
                                class="text-blue-600 hover:underline"
                            >
                                {{ invitation.client?.name }}
                            </Link>
                        </div>
                    </CardContent>
                </Card>

                <!-- Quick Stats -->
                <Card>
                    <CardHeader><CardTitle>Statistics</CardTitle></CardHeader>
                    <CardContent class="grid grid-cols-2 gap-4 text-center">
                        <div class="rounded bg-gray-50 p-4">
                            <div class="text-2xl font-bold">
                                {{ invitation.guests.length }}
                            </div>
                            <div class="text-xs text-gray-500">
                                Total Guests
                            </div>
                        </div>
                        <!-- Add view count, RSVP count later -->
                    </CardContent>
                </Card>
            </div>

            <!-- TAB: GUESTS -->
            <div v-if="activeTab === 'guests'" class="space-y-6">
                <!-- Add Guest Form -->
                <Card>
                    <CardHeader
                        ><CardTitle>Add New Guest</CardTitle></CardHeader
                    >
                    <CardContent>
                        <Form
                            action="/admin/guests"
                            method="post"
                            class="flex items-end gap-4"
                        >
                            <input
                                type="hidden"
                                name="invitation_id"
                                :value="invitation.id"
                            />
                            <div class="grid flex-1 gap-2">
                                <Label>Name</Label>
                                <Input
                                    name="name"
                                    placeholder="Guest Name"
                                    required
                                />
                            </div>
                            <div class="grid w-[180px] gap-2">
                                <Label>Phone (WA)</Label>
                                <Input
                                    name="phone"
                                    placeholder="08..."
                                    required
                                />
                            </div>
                            <div class="grid w-[120px] gap-2">
                                <Label>Group</Label>
                                <select
                                    name="guest_group"
                                    class="h-10 rounded-md border border-input bg-background px-3 text-sm"
                                >
                                    <option>Keluarga</option>
                                    <option>Teman</option>
                                    <option>Kerja</option>
                                    <option selected>Lainnya</option>
                                </select>
                            </div>
                            <div class="grid w-[80px] gap-2">
                                <Label>Quota</Label>
                                <Input
                                    type="number"
                                    name="quota"
                                    value="1"
                                    min="1"
                                    required
                                />
                            </div>
                            <Button type="submit">Add</Button>
                        </Form>
                    </CardContent>
                </Card>

                <!-- Guest List -->
                <Card>
                    <CardContent class="p-0">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-100 dark:bg-gray-800">
                                <tr>
                                    <th class="p-4">Name</th>
                                    <th class="p-4">Phone</th>
                                    <th class="p-4">Group</th>
                                    <th class="p-4">Code</th>
                                    <th class="p-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="guest in invitation.guests"
                                    :key="guest.id"
                                    class="border-t"
                                >
                                    <td class="p-4 font-medium">
                                        {{ guest.name }}
                                    </td>
                                    <td class="p-4">{{ guest.phone }}</td>
                                    <td class="p-4">
                                        <Badge variant="outline">{{
                                            guest.guest_group
                                        }}</Badge>
                                    </td>
                                    <td class="p-4 font-mono text-xs">
                                        {{ guest.guest_code }}
                                    </td>
                                    <td class="space-x-2 p-4 text-right">
                                        <Button
                                            size="sm"
                                            variant="secondary"
                                            @click="sendWhatsapp(guest)"
                                            :disabled="
                                                whatsappLoading === guest.id
                                            "
                                        >
                                            <span
                                                v-if="
                                                    whatsappLoading === guest.id
                                                "
                                                >Generating...</span
                                            >
                                            <span v-else>📲 Send WA</span>
                                        </Button>
                                        <Button
                                            size="sm"
                                            variant="ghost"
                                            class="text-red-500 hover:bg-red-50 hover:text-red-700"
                                            @click="
                                                confirmDeleteGuest(guest.id)
                                            "
                                        >
                                            <Trash2 class="h-4 w-4" />
                                        </Button>
                                    </td>
                                </tr>
                                <tr v-if="invitation.guests.length === 0">
                                    <td
                                        colspan="5"
                                        class="p-8 text-center text-gray-500"
                                    >
                                        No guests added yet.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </CardContent>
                </Card>
            </div>

            <!-- Confirm Dialog -->
            <ConfirmDialog
                :open="showConfirmDialog"
                title="Delete Guest"
                message="Are you sure you want to delete this guest? This action cannot be undone."
                @update:open="showConfirmDialog = $event"
                @confirm="handleDeleteGuest"
            />

            <!-- TAB: EVENTS -->
            <div v-if="activeTab === 'events'">
                <Card>
                    <CardHeader><CardTitle>Events</CardTitle></CardHeader>
                    <CardContent>
                        <div class="space-y-4">
                            <div
                                v-for="event in invitation.events"
                                :key="event.id"
                                class="rounded-lg border p-4"
                            >
                                <h3 class="font-bold">
                                    {{ event.event_name }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    {{
                                        new Date(
                                            event.event_date,
                                        ).toLocaleDateString()
                                    }}
                                    at {{ event.event_time_start }}
                                </p>
                                <p class="text-sm">{{ event.venue_name }}</p>
                            </div>
                            <div
                                v-if="invitation.events.length === 0"
                                class="py-4 text-center text-gray-500"
                            >
                                No events configured.
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
