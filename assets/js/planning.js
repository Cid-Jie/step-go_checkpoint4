import Vue from "vue";
import Vuetify from 'vuetify';
import Planning from "./vue-components/Planning";

document.addEventListener('DOMContentLoaded', () => {
    // Recherche du container pour instancier le planning
    const container = document.getElementById('planning-container');
    // Si le container est trouvé
    if (container) {
        // Import Vuetify pour Vue
        Vue.use(Vuetify);
        // Instanciation de Vue
        new Vue({
            // Import du composant Planning
            components: {
                Planning
            },
            // Modification des délimiteurs (facultatif)
            delimiters: ['${', '}$'],
            // Activation de Vuetify pour l'instance courante de Vue
            vuetify: new Vuetify(),
        })
            // Montage de l'application sur l'élement #planning-container
            .$mount('#planning-container');
    }
});