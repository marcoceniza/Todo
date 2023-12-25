import { defineStore } from 'pinia';

export const useCustomStore = defineStore('customID', () => {

    const formatText = (text) => {
        let firstLetter = text.slice(0, 1).toUpperCase();
        let allLetter = text.slice(1);
        
        return firstLetter.concat(allLetter);
    }

    return {
        // return variable

        // return function 
        formatText
    }
})
