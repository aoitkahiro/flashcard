class Challenge {
    constructor(data){
        this.total_sec = 0.0;
        this.missNum = 0;
        this.questions = [];
        data.questions.forEach(question => {
            this.questions.push(new ChoiceQuiz(question));
        })
    }

    initDisplay(){
        drawElmFromTpl(gameStatusTpl, gameStatusElm, {status: message.pause});
        drawElmFromTpl(missCounterTpl, missCounterElm, {miss: challenge.missNum});
        drawElmFromTpl(askedCardsQuestionTpl, askedCardQuestionElm, {question: message.unknown});
    }

    async flow(){
        let challengeTimer = new Timer({displayed: true});
        for(const question of this.questions){
            question.initDisplay();
            challengeTimer.start();
            const questionTimer = new Timer({});
            questionTimer.start();
            await question.choose();
            question.judge();
            challengeTimer.stop();
            questionTimer.stop();
            question.sec = questionTimer.getSeconds();
            question.showResult();
            await wait(1000);
        };
        challengeTimer.stop();
        this.total_sec = challengeTimer.ms;
    }

    showResult(){
        console.log(this);
        quizBoardElm.style.display = 'none';
        resultBoardElm.style.display = 'block';
        for (let i = 0; i < this.questions.length; i++) {
            const q = this.questions[i];
            resultChoiceElms[i].textContent = q.playerChoice.answer;
            if(q.isCorrect){
                resultIsCorrectElms[i].textContent = message.correctSign;
            }else{
                resultIsCorrectElms[i].textContent = message.inCorrectSign;
                resultIsCorrectElms[i].parentElement.classList.add("table-danger");
            }
        }
    }
    
    sendResult(){}

}

class ChoiceQuiz {
    constructor(data){
        this.askedCard = data.asked_card;
        this.notAskedCards = data.not_asked_cards;
        this.isCorrect = null;
        this.sec = 0.0;
        this.selectionCards = this.generateSelections();
        this.playerChoice = null;
    }

    generateSelections(){
        let selections = [...this.notAskedCards, this.askedCard];
        //シャッフルアルゴリズムFisher-Yates
        for(var i =selections.length-1 ; i>0 ;i--){
            var j = Math.floor( Math.random() * (i + 1) ); //random index
            [selections[i],selections[j]]=[selections[j],selections[i]]; // swap
        }
        return selections;
    }

    choose(){
        return new Promise(resolve => {
            for(const choiceElm of choiceElms){
                choiceElm.addEventListener("click", (e)=>{
                    //FIXME: choose()が呼ばれるごとに、重複してイベントが登録されてしまうので、回答済みのthis.playerChoiceが毎度上書きされてしまうバグ
                    //ベストな解決策は、イベントの登録を一度だけにするか、毎回イベントを削除するかだが、半日やって実装できず。。
                    //応急処置でthis.playerChoiceが上書きされないように、下記のコードを記述したが、Promiseの仕様を学習し、もっとシンプルに実装したい
                    //cosole.log("bug");
                    const tmpPlayerChoice = this.selectionCards.find( card => e.currentTarget.textContent == card.answer);
                    if(tmpPlayerChoice && !this.playerChoice){
                        this.playerChoice = tmpPlayerChoice;
                    }
                    resolve()
                });
            }
        })
    }

    judge(){
        this.isCorrect = this.playerChoice == this.askedCard;
    }

    initDisplay(){
        drawElmFromTpl(gameStatusTpl, gameStatusElm, {status: message.playing});
        drawElmFromTpl(askedCardsQuestionTpl, askedCardQuestionElm, {question: this.askedCard.question});
        for (let i = 0; i < choiceElms.length; i++) {
            choiceElms[i].textContent = this.selectionCards[i].answer
        }
    }

    showResult(){
        let result;
        if(this.isCorrect){
            result = message.correct;
        }else{
            result = message.inCorrect;
            challenge.missNum++;
        }
        drawElmFromTpl(gameStatusTpl, gameStatusElm, {status: `${message.pause} ${result}`});
        drawElmFromTpl(missCounterTpl, missCounterElm, {miss: challenge.missNum});
    }
}

class Timer {
    constructor({displayed = false}) {
        this.displayed = displayed;
        this.delay = 10; //Delay in ms
        this.ms = 0;
    }
    
    start() {
        this.interval = setInterval(()=>{
            this.ms += this.delay;
            if(this.displayed){
                drawElmFromTpl(timerTpl, timerElm, {time: this.formatTime()});
            }
        }, this.delay);
    }
    
    stop() {
        clearInterval(this.interval);
        this.interval = null;
    }

    getSeconds(){
        return this.ms / 1000;
    }
        
    formatTime() {
        let hours   = Math.floor(this.ms / 3600000);
        let minutes = Math.floor((this.ms - (hours * 3600000)) / 60000);
        let seconds = Math.floor((this.ms - (hours * 3600000) - (minutes * 60000)) / 1000);
        let ds = Math.floor((this.ms - (hours * 3600000) - (minutes * 60000) - (seconds * 1000))/this.delay);

        if (hours   < 10) {hours   = "0"+hours;}
        if (minutes < 10) {minutes = "0"+minutes;}
        if (seconds < 10) {seconds = "0"+seconds;}
        if (ds < this.delay) {ds = "0"+ds;}
        return hours+':'+minutes+':'+seconds+'.'+ds;
    }
  }
  

const challenge = new Challenge(Laravel.challenge);
console.log(challenge);

const gameStatusElm = document.getElementById('game-status');
const timerElm = document.getElementById('timer');
const missCounterElm = document.getElementById('miss-counter');
const askedCardImageElm = document.getElementById('asked-card-image');
const askedCardQuestionElm = document.getElementById('asked-card-question');
const choiceElms = document.getElementsByClassName('choices');
const quizBoardElm = document.getElementById('quiz-board');
const resultBoardElm = document.getElementById('result-board');
const resultChoiceElms = document.getElementsByClassName('result-choice');
const resultIsCorrectElms = document.getElementsByClassName('result-is-correct');

const gameStatusTpl = document.getElementById('game-status-tpl');
const timerTpl = document.getElementById('timer-tpl');
const missCounterTpl = document.getElementById('miss-counter-tpl');
const askedCardsQuestionTpl = document.getElementById('asked-card-question-tpl');

const message = {
    pause: "PAUSE",
    playing: "PLAYING",
    unknown: "???",
    correct: '正解',
    inCorrect: '不正解',
    correctSign: '○',
    inCorrectSign: '×',
};

main()

async function main(){
    challenge.initDisplay();
    await countDown(3);
    await challenge.flow();
    challenge.showResult();
    challenge.sendResult();
}

async function countDown(sec){
    for(let i = sec; i > 0; i--) {
        drawElmFromTpl(timerTpl, timerElm, {time: i});
        await wait(1000);
    }
}

function wait(ms) {
  return new Promise( resolve => { setTimeout( resolve, ms ) } );
}

function drawElmFromTpl(tpl, toElm, replaceVals){
    const clone = document.importNode(tpl.content, true);
    const fragment = document.createDocumentFragment();
    clone.textContent = replaceTplVals(clone.textContent, replaceVals);
    fragment.appendChild(clone);
    toElm.textContent = fragment.textContent;
}

/*
    args1: 'My name is ${hoge}. I'm ${age}.' , args2: {hoge: 'Taro', age: 27})
    return 'My name is Taro. I'm 27.'
*/
function replaceTplVals(string, vals) {
    return string.replace(/\$\{(.*?)\}/g, function (all, key) {
        return Object.prototype.hasOwnProperty.call(vals, key) ? vals[key] : '';
    });
}