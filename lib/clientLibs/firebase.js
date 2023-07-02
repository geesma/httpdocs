import { getApps, getApp, initializeApp } from 'firebase/app'
import { getAuth, signInWithCustomToken } from 'firebase/auth'
import { fireConfigClient } from './fireConfig'

const app = initializeApp(fireConfigClient)

const auth = getAuth(app)

export function makeAuth(token) {
  signInWithCustomToken(auth, token)
    .then((userCredential) => {
      const user = userCredential.user
      console.log({ user })
    })
    .catch((error) => {
      const errorCode = error.code
      const errorMessage = error.message
      console.log({ errorCode, errorMessage })
    })
}
