

export default function ({ store, error }) {
    if (!store.dispatch.getToken) {
      error({
        message: 'You are not connected ..aslkda;sd',
        statusCode: 403
      })
    }
  }
  