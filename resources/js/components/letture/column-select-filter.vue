<script setup lang="ts" generic="TData extends RowData">
import type { RowData } from '@tanstack/vue-table';
import Select from '@/components/ui/select/Select.vue';
import SelectContent from '@/components/ui/select/SelectContent.vue';
import SelectGroup from '@/components/ui/select/SelectGroup.vue';
import SelectItem from '@/components/ui/select/SelectItem.vue';
import SelectTrigger from '@/components/ui/select/SelectTrigger.vue';
import SelectValue from '@/components/ui/select/SelectValue.vue';
import type { AppTable } from './table-types';

const ALL_VALUE = '__all__';

defineProps<{
    table: AppTable<TData>;
    columnId: string;
    placeholder?: string;
}>();

function onUpdate(table: AppTable<TData>, columnId: string, value: string) {
    table
        .getColumn(columnId)
        ?.setFilterValue(value === ALL_VALUE ? undefined : value);
}
</script>
<template>
    <Select
        :model-value="table.getColumn(columnId)?.getFilterValue() as string"
        @update:model-value="onUpdate(table, columnId, $event as string)"
    >
        <SelectTrigger class="w-45">
            <SelectValue :placeholder="placeholder || 'Select an option'" />
        </SelectTrigger>
        <SelectContent>
            <SelectGroup>
                <SelectItem :value="ALL_VALUE">Tutto</SelectItem>
                <SelectItem value="1"> LUCE </SelectItem>
                <SelectItem value="2"> ACQUA </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
</template>
<style scoped></style>
