const bearer_token = "hZv7fACL4lt8hXTU0lHdRVf7MoAkRtsIRgIRLA9A";
const bearer = `Bearer ${bearer_token}`;

class DataMenus {
  static getDataMenu() {
    return fetch("http://127.0.0.1:8000/api/menu", {
        method: "GET",
                headers: {
                    "Authorization": bearer
                }
    })
      .then((response) => {
        return response.json();
      })
      .then((responseJson) => {
          $(`.bodyModalOrder .loading`).remove();
          if (responseJson.menu) {
          return Promise.resolve(responseJson.menu);
        } else {
          return Promise.reject(`Data not found!`);
        }
      });
  }
}

export default DataMenus;
