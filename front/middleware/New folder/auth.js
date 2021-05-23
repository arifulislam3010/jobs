export default function ({ store, error }) {
    if (!store.state.admin.user.login.isAuthenticated) {
      error({
        message: 'You are not connected',
        statusCode: 403
      })
    }
  }