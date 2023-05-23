<template>
  <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 font-poppins">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" />
      <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-gray-900">Visitor Management System</h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form class="space-y-6" @submit.prevent="handleLogin()">
          <div>
            <label for="email" class="block text-xs font-medium leading-6 text-gray-900">Email address</label>
            <div class="mt-2">
              <input v-model="form.email" id="email" name="email" type="email" autocomplete="email" placeholder="example@email.com" class="block pl-2 text-xs w-full rounded-md border py-1.5 text-gray-900 placeholder:text-gray-400 focus:outline-none sm:leading-6" />
            </div>
          </div>

          <div>
            <label for="password" class="block text-xs font-medium leading-6 text-gray-900">Password</label>
            <div class="mt-2">
              <input v-model="form.password" id="password" name="password" type="password" autocomplete="current-password" placeholder="••••••••" class="block pl-2 text-xs w-full rounded-md border py-1.5 text-gray-900 placeholder:text-gray-400 focus:outline-none sm:leading-6" />
            </div>
          </div>

          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
              <label for="remember-me" class="ml-2 block text-xs text-gray-900">Remember me</label>
            </div>

            <div class="text-sm">
              <a href="#" class="font-medium text-indigo-600 text-xs hover:text-indigo-500">Forgot your password?</a>
            </div>
          </div>

          <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>


<script setup>
  import {ref} from 'vue';
  import {userAuthStore} from '@/store/auth';
  const form = ref({
    email: '',
    password: '',
  });

  const store = userAuthStore();

  function handleLogin(){
    store.login(form);
  }

</script>