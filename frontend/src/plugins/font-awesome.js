import {library} from '@fortawesome/fontawesome-svg-core'
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

/**
 * solid icons
 */
import {
    faHome as fasHome,
    faBook as fasBook,
    faDoorClosed as fasDoorClosed,
    faDoorOpen as fasDoorOpen,
    faPencilAlt as faPencilAlt,
    faTrash as fasTrash,
} from '@fortawesome/free-solid-svg-icons'

/**
 * regular icons
 */
import {
    faUser as farUser

} from '@fortawesome/free-regular-svg-icons'


library.add(
    fasHome,
    fasBook,
    fasDoorOpen,
    fasDoorClosed,
    farUser,
    faPencilAlt,
    fasTrash
)
;

export {FontAwesomeIcon};