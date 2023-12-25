import { ref, computed } from 'vue';
import api from '@/main';
import { defineStore } from 'pinia';

export const useTodoStore = defineStore('todoID', () => {
    const todoList = ref([]);
    const isLoading = ref(true);
    const newTodo = ref('');
    const isAddingTodo = ref(false);
    const isLoadingTodo = ref(false);

    const getTodoData = async () => {
        try {
            const res = await api.get('/');
            todoList.value = res.data.result;
            isLoading.value = false;
        }catch(error) {
            console.error('Error fetching data:', error);
        }
    }

    const addTodoData = async () => {
        try {
            isAddingTodo.value = true;
            const formData = new FormData();
            formData.append('title', newTodo.value);

            const res = await api.post('add', formData);
            if(res.data.success) getTodoData();
            isAddingTodo.value = false;
            newTodo.value = '';
        }catch(error) {
            console.error('Error adding data:', error);
        }
    }

    const deleteTodoData = async (todoID) => {
        try {
            isLoadingTodo.value = true;
            const formData = new FormData();
            formData.append('todoID', todoID);

            const res = await api.post('delete', formData);
            if(res.data.success) getTodoData();
            isLoadingTodo.value = false;
        }catch(error) {
            console.error('Error deleting data:', error);
        }
    }

    const isDone = async (todoID) => {
        try {
            isLoadingTodo.value = true;
            const formData = new FormData();
            formData.append('todoID', todoID);

            const res = await api.post('', formData);
            if(res.data.success) getTodoData();
            isLoadingTodo.value = false;
        }catch(error) {
            console.error('Error deleting data:', error);
        }
    }

    const isImportant = async (todoID) => {
        try {
            isLoadingTodo.value = true;
            const formData = new FormData();
            formData.append('todoID', todoID);

            const res = await api.post('important', formData);
            if(res.data.success) getTodoData();
            isLoadingTodo.value = false;
        }catch(error) {
            console.error('Error changing important status:', error);
        }
    }

    const isCompleted = async (todoID) => {
        try {
            isLoadingTodo.value = true;
            const formData = new FormData();
            formData.append('todoID', todoID);

            const res = await api.post('completed', formData);
            if(res.data.success) getTodoData();
            isLoadingTodo.value = false;
        }catch(error) {
            console.error('Error changing completed status:', error);
        }
    }

    return {
        // return variable
        todoList, isLoading, newTodo,
        isAddingTodo, isLoadingTodo,

        // return function 
        getTodoData, addTodoData, deleteTodoData,
        isDone, isImportant, isCompleted
    }
})
