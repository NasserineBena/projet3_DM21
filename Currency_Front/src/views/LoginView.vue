<script>
import axios from "axios";
// import AddAndEditCurrency from "@/components/AddAndEditCurrency.vue";
// import AddAndEditPair from "@/components/AddAndEditPair.vue";
export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  emits: ["connexion"],
  methods: {
    connexion() {
      this.$emit("connexion", this.email, this.password);
    },
  },
  created() {},
};
</script>
<template>
  <div class="margin">
    <div class="body">
      <div>
        <p class="titre">Connexion</p>
        <form @submit.prevent="connexion">
          <div class="fields">
            <div class="four wide field">
              <label>E-mail</label><br />
              <input
                type="email"
                name="email"
                placeholder="email"
                v-model="email"
              /><br />
              <label>Password</label><br />
              <input
                type="password"
                name="password"
                placeholder="password"
                v-model="password"
              /><br />
            </div>
            <div class="buttonCenter">
              <button type="submit" class="buttonConnexion">
                Me connecter
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<style scoped>
.margin {
  padding-top: 150px;
}
.body {
  padding: 50px;
  border-radius: 25px;
  font-size: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #ecf0f1;
  width: 50%;
  margin: 0 auto;
}
label {
  color: #34495e;
}
.titre {
  color: #34495e;
  font-size: 30px;
  text-align: center;
  margin: 20px;
}
input {
  padding: 12px;
  min-width: 250px;
  border-radius: 5px;
  margin-top: 15px;
  margin-bottom: 15px;
  border: 2px solid #34495e;
}
.buttonCenter {
  display: flex;
  justify-content: center;
}
.buttonConnexion {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 30px;
  padding: 8px;
  border-radius: 8px;
  border: 2px solid #05c46b;
  font-size: 15px;
  color: white;
  cursor: pointer;
  background-color: #05c46b;
}
.cursor-pointer {
  cursor: pointer;
  background-color: #95a5a6;
  margin-right: 10px;
  border-radius: 10px;
}
</style>
