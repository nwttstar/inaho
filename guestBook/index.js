var contents = new Vue({
    el: '#mainContents',
    data: {
        contents: [],
        passwordInput: '',
        delDialog: false,
        addAnimationSwitch: '',
        addFirst: false,
        delNum: '',
        delAdress: 'https://guestbookapi.herokuapp.com/del',
        dateLiteral(dateStmt){
            let dateSplit = dateStmt.split(/[-T:]/);
            let dateSplited = dateSplit[0] + "-" + dateSplit[1] + "-" + dateSplit[2] + " " + this.jpnTime(dateSplit[3]) + ":" + dateSplit[4];
            return dateSplited;
        },
        jpnTime(hourStr) {
            let hourNum = Number(hourStr);
            hourNum += 9;
            if(hourNum > 23){
                hourNum -= 24;
            }
            return String(hourNum);
        },
        delButton(id) {
            axios
            .post(this.delAdress, {
                'id': id,
                'password' : this.passwordInput
            })
            .then(response => {
                console.log(response)
                this.reload();
            })
            .catch(error => {
                console.log(error)
            }) 
            this.delDialog = false;
            this.passwordInput = '';
        }
    },
    methods: {
      reload() {
        if(this.addFirst === true) this.addAnimationSwitch = 'addAnimation';
        this.addFirst = true;
        axios
        .get('https://guestbookapi.herokuapp.com/')
        .then(response => {
            this.contents = response.data.message;
        })
        .catch(error => {
            console.log(error)
        })
      }  
    },
    created() {
        this.reload();
    }
})
var postPop = new Vue({
    el: '#post',
    data: {
        postForm: false,
        name: '',
        title: '',
        text: '',
        password: '',
        action: 'https://guestbookapi.herokuapp.com/post'
    },
    methods: {
        postAxios() {
            if(!this.name) this.name = '吾輩は猫である。名前はまだない';
            if(!this.title) this.title = '無題';
            axios
            .post(this.action, {
                'name': this.name,
                'title': this.title,
                'password': this.password,
                'text': this.text
            })
            .then(response => {
                contents.reload();
                this.postForm = !this.postForm;
                console.log(response);
            })
            .catch(error => {
                console.log(error)
            }) 
        },
        reset() {
            this.name = '';
            this.title = '';
            this.text = '';
        }
    }
})