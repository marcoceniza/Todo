<template>
  <main>
    <div class="w-[500px] mx-auto">
      <div class="text-center flex justify-between items-center mt-5">
        <h2 class="text-3xl font-bold">Todo</h2>
        <ul class="flex gap-2">
          <li @click="isTodoView = 0" class="text-[#555] text-[14px] cursor-pointer">All</li>
          <li @click="isTodoView = 1; todoStore.getTodoData" class="text-[#555] text-[14px] cursor-pointer">Important</li>
          <li @click="isTodoView = 2" class="text-[#555] text-[14px] cursor-pointer">Done</li>
        </ul>
      </div>
      <div class="flex flex-col">
        <input type="text" placeholder="Enter New Todo" v-model="todoStore.newTodo" @keyup.enter="todoStore.addTodoData" :class="{ 'opacity-[0.5]': todoStore.isAddingTodo }" class="w-100 border rounded-[30px] p-3 my-2" :disabled="todoStore.isAddingTodo">
        <p v-if="todoStore.isLoading" class="text-center mt-3 text-gray-500">Loading...</p>
        <p v-else-if="todoStore.todoList.length === 0" class="text-center mt-3 text-gray-500">No Data</p>
        <div v-else>
          <TodoList :todo-data="todoStore.todoList" :todo-view="isTodoView"/>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import TodoList from '@/components/TodoList.vue';
import { useTodoStore } from '@/stores/todoStore';

const todoStore = useTodoStore();
const isTodoView = ref(0);

onMounted(() => {
  todoStore.getTodoData();
});
</script>