var contents = new Vue({
    el: '#mainContents',
    data: {
        contents: [],
        contentsTemp: [],
        passwordInput: '',
        delDialog: false,
        delError: false,
        addAnimationSwitch: '',
        addFirst: false,
        delNum: '',
        delAdress: 'https://guestbookapi.herokuapp.com/del',
        indexFrom: 0,
        indexTo: 7,
        indexMax: 0,
        page: 0,
        pageNowCookie: '',
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
                'password' : this.passwordInput,
                'id': id
            })
            .then(response => {
                console.log(response.status);
                this.reload();
            })
            .catch(error => {
                console.log(error);
                console.log(error.response.status);
                this.delError = true;
            }) 
            this.delDialog = false;
            this.passwordInput = '';
        }
    },
    methods: {
      reload(pageIndex) {
        if(this.addFirst === true) this.addAnimationSwitch = 'addAnimation';
        if(pageIndex === this.pageNowCookie) return;
        this.addFirst = true;
        axios
        .get('https://guestbookapi.herokuapp.com/')
        .then(response => {
            this.indexMax = Math.ceil(response.data.count / 7);
            this.contentsTemp = response.data.message;
            this.contents = this.contentsTemp.slice(this.indexFrom, this.indexTo);
            this.pageNowCookie = Math.floor((this.indexFrom + 1) / 7)
            this.indexFrom = 0;
            this.indexTo = 7;
        })
        .catch(error => {
            console.log(error)
            this.delError = true;
        })
      },
      errorDialog(massage) {
        if(this.delError) alert(massage);
        this.delError = false;
      },
      pageNow(pageIndex) {
        if(pageIndex === this.pageNowCookie) {
            return 'indexThere';
        } else {
            return 'indexList';
        }
      },
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



