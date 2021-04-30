class TestWebWorker {
  constructor() {
    this.output = document.getElementById('primary');
    this.worker;
    this.setEvents();
  }

  setEvents = () => {
    document.addEventListener('DOMContentLoaded', this.init);
  };

  init = () => {
    // console.log('Test Web Worker reworked');
    this.worker = new Worker('TestWebWorkerFile.js');
    // this.worker.addEventListener('message', this.workerMessaged);
    // this.worker.addEventListener('error', this.workerError);

    this.worker.postMessage('Get Started');
    this.worker.postMessage('Fetch');

    // this.output.addEventListener('click', () => {
    //   this.worker.postMessage('Other');
    // });
  };

  workerMessaged = (e) => {
    let data = e.data;
    this.output.textContent += data + '\n';
  };

  workerError = (e) => {
    console.log(e.message, e.filename);
  };
}

export default TestWebWorker;
