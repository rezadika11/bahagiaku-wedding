<script setup lang="ts">
import { Label } from '@/components/ui/label';
import { Calendar } from 'lucide-vue-next';
import { ref, watch } from 'vue';

interface Props {
    modelValue?: string;
    label?: string;
    name?: string;
    required?: boolean;
    placeholder?: string;
}

const props = withDefaults(defineProps<Props>(), {
    label: '',
    name: '',
    required: false,
    placeholder: 'Select date',
});

const emit = defineEmits<{
    'update:modelValue': [value: string];
}>();

const dateValue = ref(props.modelValue || '');

watch(
    () => props.modelValue,
    (newValue) => {
        dateValue.value = newValue || '';
    },
);

const handleInput = (event: Event) => {
    const target = event.target as HTMLInputElement;
    dateValue.value = target.value;
    emit('update:modelValue', target.value);
};
</script>

<template>
    <div class="grid gap-2">
        <Label v-if="label" :for="name">{{ label }}</Label>

        <div class="relative">
            <input
                :id="name"
                type="date"
                :name="name"
                :value="dateValue"
                :required="required"
                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 pr-10 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:outline-none disabled:cursor-not-allowed disabled:opacity-50"
                @input="handleInput"
            />
            <div
                class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2"
            >
                <Calendar class="h-4 w-4 text-gray-400" />
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Hide native calendar icon */
input[type='date']::-webkit-calendar-picker-indicator {
    position: absolute;
    right: 0;
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    opacity: 0;
    cursor: pointer;
}
</style>
