
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'

module.exports = {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/filament/**/*.blade.php",
    ],
  plugins: [
      forms,
      typography,
  ],
}

 

// import preset from './vendor/filament/support/tailwind.config.preset'

// export default {
//     presets: [preset],
//     content: [
//         './app/Filament/**/*.php',
//         './resources/views/**/*.blade.php',
//         './vendor/filament/**/*.blade.php',
//     ],
// }
