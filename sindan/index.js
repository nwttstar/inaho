var contents = new Vue ({
    el: '#contents',
    data: {
        questions: [
            {
                id: 1,
                title: '性別',
                items: [
                    {myPoint:0, youPoint:0, select:'男'},
                    {myPoint:100, youPoint:100, select:'女'}
                ]
            },
            {
                id: 2,
                title: 'あなたはうるさい人ですか？',
                items: [
                    {myPoint:7, youPoint:0, select:'うるさい方かも'},
                    {myPoint:2, youPoint:0, select:'どうだろう'},
                    {myPoint:0, youPoint:0, select:'静かな方だ'}
                ]
            },
            {
                id: 3,
                title: '想い人は騒がしい人ですか？',
                items: [
                    {myPoint:0, youPoint:10, select:'うるさい方だ'},
                    {myPoint:0, youPoint:4, select:'そんなことはない'},
                    {myPoint:0, youPoint:3, select:'物静かだ'}
                ]
            },
            {
                id: 4,
                title: 'あなたは一人が好きですか？',
                items: [
                    {myPoint:6, youPoint:0, select:'一人でいるのは好きじゃない'},
                    {myPoint:1, youPoint:0, select:'できるだけ一人でいたい'},
                    {myPoint:3, youPoint:0, select:'気心知れた人なら一緒に居たい'}
                ]
            },
            {
                id: 5,
                title: '想い人は友だちが多いほうですか？',
                items: [
                    {myPoint:0, youPoint:12, select:'多いほうだ'},
                    {myPoint:0, youPoint:4, select:'多くはないと思う'},
                    {myPoint:0, youPoint:2, select:'一人でいることが多い'}
            ]
            },
            {
                id: 6,
                title: 'あなたは細かいことを気にする方ですか？',
                items: [
                    {myPoint:0, youPoint:0, select:'まったく気にしない'},
                    {myPoint:3, youPoint:0, select:'どちらかといえばそう'},
                    {myPoint:8, youPoint:0, select:'神経質な方だ'}
                ]
            },
            {
                id: 7,
                title: '親友と遊びに行くならどこ？',
                items: [
                    {myPoint:8, youPoint:0, select:'アウトドア'},
                    {myPoint:6, youPoint:0, select:'カラオケ'},
                    {myPoint:4, youPoint:0, select:'ボーリング'},
                    {myPoint:2, youPoint:0, select:'映画'},
                    {myPoint:3, youPoint:0, select:'カフェ'}
                ]
            }],
            myScore: 0,
            youScore: 0,
            myTotalScore: 0,
            youTotalScore: 0,
            index: -1,
            totalScore: 0,
            resultScore: null,
            resultContent: null,
            resultContentIn: "resultContent resultContentIn",
            resultContentOut: "resultContent resultContentOut"
    },
    methods: {
        count: function(my, you){
            this.myTotalScore += my;
            this.youTotalScore += you;
        },
        result: function(resultScore){
            this.totalScore = this.myTotalScore - this.youTotalScore;
            jadge = Math.abs(this.totalScore);
            if ( (jadge < 5) || (100 <= jadge < 105) ) {
                return resultScore = "相性は抜群です。";
            } else if ( (jadge < 9) || (109 <= jadge < 114) ) {
                return resultScore = "相性はふつうです。";
            } else {
                return resultScore = "相性は最悪です。";
            }
        },
        indexReset: function(){
            this.index = -1;
        },
        restart: function(){
            this.resultContent = this.resultContentOut;
            setTimeout(this.indexReset, 900);
            
        }
    }
})