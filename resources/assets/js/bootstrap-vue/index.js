import Vue from 'vue';
import Bar from './components/Bar';
import ManageModal from './components/ManageModal';


new Vue({
    el: '#cookie-consent',
    components: {
        'cookie-consent-bar': Bar,
        'cookie-manage-modal': ManageModal,
    },
    mounted() {
        this.$el.style.display = '';
    }
});