<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { ArrowRight, Calendar, Clock, Mail, Users } from 'lucide-vue-next';

interface Props {
    stats: {
        total_invitations: number;
        published_invitations: number;
        total_clients: number;
    };
    upcoming_weddings: Array<{
        id: number;
        slug: string;
        couple_name: string;
        wedding_date: string;
        client_name: string;
        is_today: boolean;
    }>;

    recent_activity: Array<{
        id: number;
        description: string;
        created_at: string;
        user: string;
    }>;
    chart_data: {
        labels: string[];
        series: number[];
    };
    pie_chart_data: {
        labels: string[];
        series: number[];
    };
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

const chartOptions = {
    chart: {
        id: 'invitations-chart',
        fontFamily: 'inherit',
        toolbar: { show: false },
    },
    xaxis: {
        categories: props.chart_data.labels,
    },
    theme: {
        mode: 'light',
    },
    colors: ['#0f172a'],
    plotOptions: {
        bar: {
            borderRadius: 4,
            columnWidth: '15%',
        },
    },
    dataLabels: {
        enabled: false,
    },
    grid: {
        show: false,
    },
    yaxis: {
        show: false,
    },
};

const chartSeries = [
    {
        name: 'Invitations',
        data: props.chart_data.series,
    },
];

const pieChartOptions = {
    chart: {
        id: 'invitations-status-chart',
        fontFamily: 'inherit',
    },
    labels: props.pie_chart_data.labels,
    theme: {
        mode: 'light',
    },
    colors: ['#0f172a', '#94a3b8', '#dc2626'],
    dataLabels: {
        enabled: true,
    },
    legend: {
        position: 'bottom' as const,
    },
};

const pieChartSeries = props.pie_chart_data.series;
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-4 p-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold tracking-tight">Dashboard</h1>
            </div>
            <!-- Stats Grid -->
            <div class="grid gap-4 md:grid-cols-3">
                <div class="rounded-xl border bg-card p-6 shadow-sm">
                    <div
                        class="flex flex-row items-center justify-between space-y-0 pb-2"
                    >
                        <div class="text-sm font-medium">Total Invitations</div>
                        <Mail class="h-4 w-4 text-muted-foreground" />
                    </div>
                    <div class="pt-2">
                        <div class="text-2xl font-bold">
                            {{ stats.total_invitations }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            {{ stats.published_invitations }} published
                        </p>
                    </div>
                </div>
                <div class="rounded-xl border bg-card p-6 shadow-sm">
                    <div
                        class="flex flex-row items-center justify-between space-y-0 pb-2"
                    >
                        <div class="text-sm font-medium">Total Clients</div>
                        <Users class="h-4 w-4 text-muted-foreground" />
                    </div>
                    <div class="pt-2">
                        <div class="text-2xl font-bold">
                            {{ stats.total_clients }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            Active clients managed
                        </p>
                    </div>
                </div>
                <div class="rounded-xl border bg-card p-6 shadow-sm">
                    <div
                        class="flex flex-row items-center justify-between space-y-0 pb-2"
                    >
                        <div class="text-sm font-medium">Upcoming Weddings</div>
                        <Calendar class="h-4 w-4 text-muted-foreground" />
                    </div>
                    <div class="pt-2">
                        <div class="text-2xl font-bold">
                            {{ upcoming_weddings.length }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            Next 5 scheduled events
                        </p>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <!-- Charts Section -->
            <div class="grid gap-4 md:grid-cols-3">
                <!-- Bar Chart -->
                <div class="col-span-2 rounded-xl border bg-card shadow-sm">
                    <div class="flex flex-col space-y-1.5 p-6">
                        <h3 class="leading-none font-semibold tracking-tight">
                            User Registration Overview
                        </h3>
                        <p class="text-sm text-muted-foreground">
                            Monthly invitations created over the last 6 months.
                        </p>
                    </div>
                    <div class="p-6 pt-0">
                        <apexchart
                            width="100%"
                            height="300"
                            type="bar"
                            :options="chartOptions"
                            :series="chartSeries"
                        ></apexchart>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="rounded-xl border bg-card shadow-sm">
                    <div class="flex flex-col space-y-1.5 p-6">
                        <h3 class="leading-none font-semibold tracking-tight">
                            Invitations Status
                        </h3>
                        <p class="text-sm text-muted-foreground">
                            Distribution of invitations by current status.
                        </p>
                    </div>
                    <div class="flex justify-center p-6 pt-0">
                        <apexchart
                            width="380"
                            type="pie"
                            :options="pieChartOptions"
                            :series="pieChartSeries"
                        ></apexchart>
                    </div>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-7">
                <!-- Upcoming Weddings List -->
                <div class="col-span-4 rounded-xl border bg-card shadow-sm">
                    <div class="flex flex-col space-y-1.5 p-6">
                        <h3 class="leading-none font-semibold tracking-tight">
                            Upcoming Weddings
                        </h3>
                        <p class="text-sm text-muted-foreground">
                            Scheduled weddings for the upcoming days.
                        </p>
                    </div>
                    <div class="p-6 pt-0">
                        <div class="space-y-4">
                            <div
                                v-if="upcoming_weddings.length === 0"
                                class="py-4 text-center text-sm text-muted-foreground"
                            >
                                No upcoming weddings found.
                            </div>
                            <div
                                v-for="wedding in upcoming_weddings"
                                :key="wedding.id"
                                class="flex items-center"
                            >
                                <div class="ml-4 space-y-1">
                                    <p class="text-sm leading-none font-medium">
                                        {{ wedding.couple_name }}
                                    </p>
                                    <p class="text-sm text-muted-foreground">
                                        {{ wedding.wedding_date }}
                                        <span
                                            v-if="wedding.is_today"
                                            class="ml-2 inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800"
                                        >
                                            Today
                                        </span>
                                    </p>
                                </div>
                                <div class="ml-auto font-medium">
                                    <Link
                                        :href="`/admin/invitations/${wedding.id}`"
                                    >
                                        <ArrowRight
                                            class="h-4 w-4 text-gray-500 hover:text-gray-900"
                                        />
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="col-span-3 rounded-xl border bg-card shadow-sm">
                    <div class="flex flex-col space-y-1.5 p-6">
                        <h3 class="leading-none font-semibold tracking-tight">
                            Recent Activity
                        </h3>
                        <p class="text-sm text-muted-foreground">
                            Latest actions performed in the system.
                        </p>
                    </div>
                    <div class="p-6 pt-0">
                        <div class="space-y-4">
                            <div
                                v-if="recent_activity.length === 0"
                                class="py-4 text-center text-sm text-muted-foreground"
                            >
                                No recent activity.
                            </div>
                            <div
                                v-for="activity in recent_activity"
                                :key="activity.id"
                                class="relative flex items-start gap-4 border-l pb-4 pl-4 last:pb-0"
                            >
                                <span
                                    class="absolute top-1 -left-[5px] h-2.5 w-2.5 rounded-full bg-gray-200 ring-2 ring-white"
                                ></span>
                                <div class="space-y-1">
                                    <p class="text-sm leading-none font-medium">
                                        {{ activity.description }}
                                    </p>
                                    <div
                                        class="flex items-center gap-2 text-xs text-muted-foreground"
                                    >
                                        <Clock class="h-3 w-3" />
                                        {{ activity.created_at }} by
                                        {{ activity.user }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
