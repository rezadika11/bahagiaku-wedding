<script setup lang="ts">
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { ChevronDown, Search, X } from 'lucide-vue-next';
import { computed, ref, watch } from 'vue';

interface Option {
    value: string | number;
    label: string;
}

interface Props {
    options: Option[];
    modelValue?: string | number;
    placeholder?: string;
    label?: string;
    name?: string;
    required?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    placeholder: 'Select an option...',
    label: '',
    name: '',
    required: false,
});

const emit = defineEmits<{
    'update:modelValue': [value: string | number];
}>();

const isOpen = ref(false);
const searchQuery = ref('');
const selectedValue = ref(props.modelValue || '');

watch(
    () => props.modelValue,
    (newValue) => {
        selectedValue.value = newValue || '';
    },
);

const filteredOptions = computed(() => {
    if (!searchQuery.value) return props.options;

    const query = searchQuery.value.toLowerCase();
    return props.options.filter((option) =>
        option.label.toLowerCase().includes(query),
    );
});

const selectedLabel = computed(() => {
    const option = props.options.find(
        (opt) => opt.value === selectedValue.value,
    );
    return option?.label || props.placeholder;
});

const selectOption = (option: Option) => {
    selectedValue.value = option.value;
    emit('update:modelValue', option.value);
    isOpen.value = false;
    searchQuery.value = '';
};

const clearSelection = () => {
    selectedValue.value = '';
    emit('update:modelValue', '');
    searchQuery.value = '';
};

const toggleDropdown = () => {
    isOpen.value = !isOpen.value;
    if (isOpen.value) {
        searchQuery.value = '';
    }
};
</script>

<template>
    <div class="relative">
        <Label v-if="label" :for="name">{{ label }}</Label>

        <!-- Hidden input for form submission -->
        <input
            type="hidden"
            :name="name"
            :value="selectedValue"
            :required="required"
        />

        <!-- Selected value display -->
        <div
            class="relative mt-1 flex h-10 w-full cursor-pointer items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:outline-none"
            :class="{ 'text-gray-500': !selectedValue }"
            @click="toggleDropdown"
        >
            <span class="truncate">{{ selectedLabel }}</span>
            <div class="flex items-center gap-1">
                <button
                    v-if="selectedValue"
                    type="button"
                    class="rounded p-1 hover:bg-gray-100"
                    @click.stop="clearSelection"
                >
                    <X class="h-4 w-4" />
                </button>
                <ChevronDown
                    class="h-4 w-4 transition-transform"
                    :class="{ 'rotate-180': isOpen }"
                />
            </div>
        </div>

        <!-- Dropdown -->
        <Transition
            enter-active-class="transition duration-100 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-in"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0"
        >
            <div
                v-if="isOpen"
                class="absolute z-50 mt-1 w-full rounded-md border bg-white shadow-lg"
            >
                <!-- Search input -->
                <div class="border-b p-2">
                    <div class="relative">
                        <Search
                            class="absolute top-2.5 left-2 h-4 w-4 text-gray-400"
                        />
                        <Input
                            v-model="searchQuery"
                            placeholder="Search..."
                            class="pl-8"
                            @click.stop
                        />
                    </div>
                </div>

                <!-- Options list -->
                <div class="max-h-60 overflow-y-auto p-1">
                    <div
                        v-for="option in filteredOptions"
                        :key="option.value"
                        class="cursor-pointer rounded px-3 py-2 text-sm hover:bg-gray-100"
                        :class="{
                            'bg-blue-50 font-medium':
                                option.value === selectedValue,
                        }"
                        @click="selectOption(option)"
                    >
                        {{ option.label }}
                    </div>
                    <div
                        v-if="filteredOptions.length === 0"
                        class="px-3 py-2 text-center text-sm text-gray-500"
                    >
                        No results found
                    </div>
                </div>
            </div>
        </Transition>

        <!-- Backdrop to close dropdown -->
        <div v-if="isOpen" class="fixed inset-0 z-40" @click="isOpen = false" />
    </div>
</template>
