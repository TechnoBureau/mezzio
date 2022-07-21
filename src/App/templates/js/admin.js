import createPage from './createpage.js';

const showoff = (name) => console.log(name, ' showing off');

const admin = createPage(
  'admin',
  {
    name: 'Ganapathi Chidambaram'
  },
  {
    hit: () => alert('This alert already proof that I am a web developer!')
  },
  function () {
    this.$nextTick(() => showoff(this.name));
  }
);

export default admin;