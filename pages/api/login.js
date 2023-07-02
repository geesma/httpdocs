import { db, auth } from '../../lib/serverLibs/firebase'

export default async function handler(req, res) {
  const { username, password } = req.body
  if (!username) {
    return res.status(400).send('Missing username')
  }
  const query = db.collection('users').where('username', '==', username)
  const querySnapshot = await query.get()
  if (querySnapshot.empty) {
    return res.status(400).json({ message: 'El usuario no existe' })
  }
  const user = querySnapshot.docs[0].data()
  console.log(user)
  if (password.length === 0) {
    if (user.role !== 'player') {
      return res.status(200).json({ message: 'password_required' })
    }
  }
  if (user.role !== 'player') {
    const bcrypt = require('bcrypt')
    const correctPassword = await bcrypt.compare(password, user.password)
    if (!correctPassword) {
      return res.status(400).json({ message: 'Password incorrecto' })
    }
  }
  const token = await auth.createCustomToken(user.id, {
    role: user.role
  })
  return res.status(200).json({ message: 'success', token, user })
}
