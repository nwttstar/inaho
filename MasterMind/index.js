var contents = new Vue({
    el: '#app',
    data: {
        start: false,
        clear: false,
        gameOver: false,
        rule: false,
        answerCount: 10,
        answerForm: 0,
        userAnswer: 0,
        correctAnswer: "",
        correctAnswers: [],
        slicedNums: [],
        hitCount: 0,
        blowCount: 0,
        logs: ""
    },
    methods: {
        // ゲームスタート・初期化
        gameStart(){
            this.start = true;
            this.answerCount = 10;
            this.answerForm = 0;
            this.slicedNums.length = 0;
            this.hitCount = 0;
            this.blowCount = 0;
            this.logs = "";
            this.correct();
        },
        // 回答を送信
        answer(){
            this.userAnswer = this.answerForm;
            this.sliceNum();
            this.blowCounter();
            this.hitCounter();
            this.logs += 'Your-Answer:' + this.answerForm + ' Blow:' + this.blowCount + ' Hit:' + this.hitCount + '\n';
            if(this.hitCount === 4){
                this.clear = true;
            }
            else if(this.answerCount <= 1){
                this.gameOver = true;
            }
            this.answerCount--;
        },
        // 入力した4桁の数字を分割して配列に格納
        sliceNum() {
            this.slicedNums.length = 0;
            for(var i = 0 ; i < 4; i++){
                this.slicedNums.push(Number(this.userAnswer.slice(i, i+1)));
            }
        },
        // 答えを生成
        correct() { 
            let pushNum = 0;
            this.correctAnswers.length = 0;
            this.correctAnswer = "";
            for(var i = 0 ; i < 4; i++){
                while(true){
                    pushNum = Math.floor(Math.random() * 10);
                    if(!this.correctAnswers.includes(pushNum)){
                        this.correctAnswers.push(pushNum);
                        break;
                    }
                }
            }
            // 文字列として答えを生成
            for(correct of this.correctAnswers){
                this.correctAnswer += correct;
            }
        },
        blowCounter() {
            this.blowCount = 0;
            for(slicedNum of this.slicedNums){
                for(correctAnswer of this.correctAnswers){
                    if(slicedNum === correctAnswer){
                        this.blowCount++;
                    }
                }
            }
        },
        hitCounter() {
            let pos = 0;
            this.hitCount = 0;
            for(slicedNum of this.slicedNums){
                if(slicedNum === this.correctAnswers[pos]){
                    this.hitCount++;
                }
                pos++;
            }
        },
        // 結果
        result() {
            if(this.slicedNum === this.correctAnswer){
                return bingo = true;
            }else if(this.slicedNum === this.corresctAnswer){
                return hit = true;
            }else if(this.slicedNum === this.correctAnswer){
                return blow = true;
            }else {
                return wrong = true;
            }
        }
    }
})