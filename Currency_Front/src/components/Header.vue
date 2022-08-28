<template>
  <div class="display">
    <p class="logo" v-on:click.prevent="changeView('')">MoneyValue</p>
    <div class="button">
      <p class="cursor-pointer" v-on:click.prevent="changeView('/currencies')">
        Devise
      </p>
      <p class="cursor-pointer" v-on:click.prevent="changeView('/pairs')">
        Paire
      </p>
      <p class="cursor-pointer buttonLogout" v-on:click.prevent="logout">
        Logout
      </p>
    </div>
  </div>
</template>
<script>
export default {
  emits: ["logout"],
  methods: {
    logout() {
      this.$emit("logout");
    },
    changeView(router) {
      this.$router.push("/admin" + router);
    },
  },
};
</script>
<style scoped>
* {
  display: flex;
  justify-content: space-between;
  background-color: #ecf0f1;
  padding: 12px 30px 12px 30px;
}
.button {
  display: flex;
  justify-content: end;
  font-size: 20px;
}
.logo {
  font-size: 40px;
}
.display {
  display: flex;
}
.buttonLogout {
  color: green;
}
.cursor-pointer {
  cursor: pointer;

  margin-right: 10px;
  border-radius: 10px;
}
.cursor-pointer:hover {
  background-color: #bdc3c7;
}
</style>
