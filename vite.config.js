import { defineConfig } from "vite";
// import { fileURLToPath, URL } from 'node:url';
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import ckeditor5 from "@ckeditor/vite-plugin-ckeditor5";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/sass/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        ckeditor5({ 
            theme: require.resolve("@ckeditor/ckeditor5-theme-lark") 
        }),
    ],
    resolve: {
        alias: {
            vue: "vue/dist/vue.esm-bundler.js",
            // '@': fileURLToPath( new URL( './src', import.meta.url ) )
        },
    },
});
