
export default {

    methods: {
      async  callApi(method, url, data, header =  {'Content-Type' : 'XMLHttpRequest'}) {
            try {
              return await axios({method: method,url: url,data: data, headers: {
                  header,
                  "Authorization" : `Bearer ${localStorage.getItem('authToken')}`
                }
              }
                  )
            }catch(e) {
                // console.log(e.response.data.errors)
                return await e.response
            }
        },
        async confirmDelete(
            title='Are you sure?',
            text = "You won't be able to revert this!",
            icon = 'warning',
            showCancelButton= '#3085d6',
            confirmButtonColor = '#3085d6',
            cancelButtonColor = '#d33',
            confirmButtonText =  'Yes, delete it!'
        ) {
          return await  Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: showCancelButton,
                confirmButtonColor: confirmButtonColor,
                cancelButtonColor: cancelButtonColor,
                confirmButtonText: confirmButtonText
            }).then((result) => {
                return result.value ? result.isConfirmed : false
            })
        },

        async fireMessage(title,message,icon){
            return await  Swal.fire(
                title,
                message,
                icon
            ).then((result) => {
                return result.value ? result.isConfirmed : false
            })
        },
        resetForm(form){
            Object.keys(form).forEach((key) => {
                this.form[key] = "";
            });
        },

    },

}
