
import router from './router.js';

const app = Vue.createApp({});
app.use(router);

router.isReady().then(() => app.mount('#root'))