import { initializeApp, cert, getApps } from 'firebase-admin/app'
import { getAuth } from 'firebase-admin/auth'
import { getFirestore } from 'firebase-admin/firestore'
import { getStorage } from 'firebase-admin/storage'
import { fireConfig } from './fireConfig'

if (getApps().length === 0) {
  initializeApp({
    credential: cert(fireConfig),
    databaseURL: 'https://familia-tipster.firebaseio.com'
  })
}

export const db = getFirestore()
export const auth = getAuth()
export const store = getStorage()
