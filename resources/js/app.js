import 'alpinejs'
import flatpickr from "flatpickr"
import { Russian } from "flatpickr/dist/l10n/ru.js"

flatpickr(".datepicker", {
    "locale": Russian,
    dateFormat: "d.m.Y"
})