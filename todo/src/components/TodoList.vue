<template>
  <main>
    <ul v-show="props.todoView == 0" class="mt-3">
        <li :class="{ 'opacity-[0.5]': todoStore.isLoadingTodo }" class="border-b mb-2 pb-2 relative" v-for="td in props.todoData" :key="td.id"><input @click="todoStore.isCompleted(td.id)" type="checkbox" :checked="td.is_completed == 1"> <span :class="{ 'line-through': td.is_completed == 1, 'text-[red]': td.is_completed == 1, 'opacity-[0.5]': td.is_completed == 1 }">{{ customStore.formatText(td.title) }}</span> <StarIcon @click="todoStore.isImportant(td.id)" :class="{ 'text-[#f9f936]': td.is_important == 1, 'pointer-events-none': td.is_completed == 1 }" class="h-5 w-5 absolute right-[25px] bottom-[9px] cursor-pointer"/><TrashIcon @click="todoStore.deleteTodoData(td.id)" class="h-5 w-5 absolute right-0 bottom-2 text-[#bd3232] cursor-pointer" /></li>
    </ul>
    <p v-show="props.todoView == 0 && props.todoData == 0" class="text-center text-[#b1b1b1]">No Data</p>
    <ul v-show="props.todoView == 1" class="mt-3">
        <li :class="{ 'opacity-[0.5]': todoStore.isLoadingTodo }" class="border-b mb-2 pb-2 relative" v-for="id in getImportantData" :key="id.id"><input @click="todoStore.isCompleted(id.id)" type="checkbox" :checked="id.is_completed == 1"> <span :class="{ 'line-through': id.is_completed == 1, 'text-[red]': id.is_completed == 1 }">{{ customStore.formatText(id.title) }}</span> <StarIcon @click="todoStore.isImportant(id.id)" :class="{ 'text-[#f9f936]': id.is_important == 1 }" class="h-5 w-5 absolute right-[25px] bottom-[9px] cursor-pointer"/><TrashIcon @click="todoStore.deleteTodoData(id.id)" class="h-5 w-5 absolute right-0 bottom-2 text-[#bd3232] cursor-pointer" /></li>
    </ul>
    <p v-show="props.todoView == 1 && getImportantData.length == 0" class="text-center text-[#b1b1b1]">No Data</p>
    <ul v-show="props.todoView == 2" class="mt-3">
      <li :class="{ 'opacity-[0.5]': todoStore.isLoadingTodo }" class="border-b mb-2 pb-2 relative" v-for="cd in getCompletedData" :key="cd.id"><input @click="todoStore.isCompleted(cd.id)" type="checkbox" :checked="cd.is_completed == 1"> <span :class="{ 'line-through': cd.is_completed == 1, 'text-[red]': cd.is_completed == 1, 'opacity-[0.5]': cd.is_completed == 1 }">{{ customStore.formatText(cd.title) }}</span> <TrashIcon @click="todoStore.deleteTodoData(cd.id)" class="h-5 w-5 absolute right-0 bottom-2 text-[#bd3232] cursor-pointer" /></li>
    </ul>
    <p v-show="props.todoView == 2 && getCompletedData.length == 0" class="text-center text-[#b1b1b1]">No Data</p>
  </main>
</template>

<script setup>
import { TrashIcon, StarIcon } from '@heroicons/vue/24/solid';
import { useCustomStore } from '@/stores/customStore';
import { useTodoStore } from '@/stores/todoStore';
import { computed } from 'vue';

const props = defineProps({
  todoData: Array,
  todoView: Number
})

const customStore = useCustomStore();
const todoStore = useTodoStore();

const getImportantData = computed(() => {
  return todoStore.todoList.filter(el => el.is_important == 1);
});

const getCompletedData = computed(() => {
  return todoStore.todoList.filter(el => el.is_completed == 1);
});
</script>
