import { useState } from 'react'
import Spinner from '../../components/icons/spinner'
import { useRouter } from 'next/router'
import { makeAuth } from '../../lib/clientLibs/firebase'

export default function Login() {
  const [{ isError, message }, setError] = useState({
    isError: false,
    message: 'wrong username !'
  })
  const [username, setUsername] = useState('')
  const [password, setPassword] = useState('')
  const [loading, setLoading] = useState(false)
  const [requiresPassword, requeresPassword] = useState(false)
  const router = useRouter()

  const handleSubmit = (e) => {
    e.preventDefault()
    if (username.length === 0) {
      return setError({
        isError: true,
        message: 'El nombre de usuario no puede estar vacio'
      })
    }
    setLoading(true)
    return fetch('/api/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        username,
        password
      })
    })
      .then((res) => res.json())
      .then((data) => {
        setLoading(false)
        if (data.message === 'password_required') {
          requeresPassword(true)
        } else if (data.message === 'success') {
          makeAuth(data.token)
          // router.push('/')
        }
      })
  }

  return (
    <div className="flex items-center justify-center w-screen h-screen bg-white">
      <div className="w-64 px-6 py-3 border rounded">
        <div className="flex flex-col items-center justify-center mb-4">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            className="w-12 h-12 mt-2"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            strokeWidth="2"
          >
            <path
              strokeLinecap="round"
              strokeLinejoin="round"
              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
            />
          </svg>
          <h2 className="mt-2 text-2xl font-bold">Inicio de sesión</h2>
        </div>
        <form onSubmit={handleSubmit}>
          <div className="flex flex-col my-2">
            <label className="text-xs text-gray-400">Nombre de usuario</label>
            <input
              className="px-3 py-1 mt-2 border rounded"
              type="text"
              placeholder="Nombre de usuario"
              onChange={(e) => setUsername(e.target.value)}
            />
          </div>
          {requiresPassword && (
            <div className="flex flex-col my-2">
              <label className="text-xs text-gray-400">Contraseña</label>
              <input
                className="px-3 py-1 mt-2 border rounded"
                type="password"
                placeholder="Contraseña"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
              />
            </div>
          )}
          {isError && (
            <div className="flex items-center justify-between mt-4 text-xs text-red-400">
              <span>
                <b>Error: </b>
                {message}
              </span>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                className="w-4 h-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                strokeWidth="2"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
            </div>
          )}
          <div className="flex flex-col items-center justify-center my-3">
            <button className="w-full py-1 my-3 text-blue-200 bg-blue-600 rounded">
              {loading ? <Spinner /> : 'Iniciar sesión'}
            </button>
          </div>
        </form>
      </div>
    </div>
  )
}
