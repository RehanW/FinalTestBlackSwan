<template>

    <div id="app">
      <div class="container">
        <header class="text-center">
          <h1 class="display-6 text-white">News 42</h1>
          <p class="text-white lead mb-0">Your local news provider</p>
          <p class="text-white lead mb-4">Brought to you by News42.net
          <p>Please click the button below to sign up and receive daily mail</p>
          <button onclick="window.location.href = '/contact'" >Sign Up!</button>
        </header>
      </div>
      <div class="container-vue">
        <body class="news-body">
          <News :apiKey="apiKey" />
        </body>
      </div>
    </div>

</template>

<script>
import News from './News.vue'
export default {
  name: 'app',
  data: () => {
    return {
      apiKey: '8036d5bd1a33421c81eeaf5409ef5cfb'
    }
  },
  components: {
    News
  }
}
</script>

<style lang="scss">

.news-body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: linear-gradient(to bottom, #80A248, #198B4D);
}
#app {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 1rem;
  color: #333;
  width: 100%;
  max-width: 480px;
  height: 95%;
  max-height: 1000px;
  background-color: #fff;

  border: 2px solid #222;
  border-radius: 20px;
  box-shadow: 5px 10px 18px #222;

  overflow-y: scroll;
  overflow-x: hidden;

}
::-webkit-scrollbar {
  display: none;
}
</style>


