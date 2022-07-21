import home       from './home.js';
import admin      from './admin.js';
import createPage from './createpage.js';
const { createRouter, createWebHistory } = VueRouter;

const routes = [
  { path: '/', component: home, meta: { title: 'Home'}  },
  { path: '/login', component: admin, meta: { title: 'Login'}  },
  { path: '/admin', component: admin, meta: { title: 'Admin'}  },
  { path: '/:pathMatch(.*)*', component: createPage('notFound'), meta: { title: 'Page Not Found' } }
];

const router = createRouter({
  history: createWebHistory(),
  routes: routes,
  base: '/',
  linkExactActiveClass: "active"
});

router.afterEach(to => document.title = to.meta.title);
export default router
