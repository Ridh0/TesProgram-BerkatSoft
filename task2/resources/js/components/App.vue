//App.vue
<template>
     <div id="app">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <router-link :to="{name: 'home'}" class="navbar-brand">Task2</router-link>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <router-link :to="{ name: 'login' }" class="nav-link">Login</router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'register' }" class="nav-link">Register</router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'product' }" class="nav-link">Produk</router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'customer' }" class="nav-link">Customer</router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'pos' }" class="nav-link">POS</router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'dashboard' }" class="nav-link">Dashboard</router-link>
          </li>
        
         
        </ul>
       
      </div>
    </nav>
    <div class="container">
        <div class="card-deck mb-3 text-center">
            <router-view></router-view>
        </div>

        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
               
                
            </div>
        </footer>
    </div>
</div>
 
</template>

<script>
</script>