import loginAxios from '../../services/Login.js'

export function login({ commit, dispatch }, user) {
  loginAxios({
    url: 'login.php/',
    data: user,
    method: 'POST'
  })
    .then(({ data }) => {
      const now = new Date()
      const expirationDate = new Date(now.getTime() + data.expiresIn * 1000)
      localStorage.setItem('tokenId', data.tokenId)
      localStorage.setItem('userId', data.userId)
      localStorage.setItem('userName', data.userId)
      localStorage.setItem('admin', data.userId)
      localStorage.setItem('expiresIn', expirationDate)
      commit('AUTH_USER', {
        token: data.idToken,
        userId: data.localId
      })
      dispatch('setLogoutTimer', data.expiresIn)
    })
    .catch(error => console.log(error))
    .catch(err => {
      localStorage.removeItem('tokenId')
      reject(err)
    })
}
export function setLogoutTimer({ commit }, expirationTime) {
  setTimeout(() => {
    commit('CLEAR_AUTH_DATA')
  }, expirationTime * 1000)
}
export function tryAutoLogin({ commit }) {
  const token = localStorage.getItem('tokenId')
  if (!token) {
    return
  }
  const expirationDate = localStorage.getItem('expiresIn')
  const now = new Date()
  if (now >= expirationDate) {
    return
  }
  const userId = localStorage.getItem('userId')
  commit('AUTH_USER', {
    tokenId: token,
    userId: userId
  })
}