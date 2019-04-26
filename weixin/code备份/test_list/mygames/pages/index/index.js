Page({
  /**
     * 页面的初始数据
     * 初始化两个输入值
     */
  data: {
    input1: 0,
    input2: 0
  },
  //获取用户输入的值a
  inputa: function (e) {
    this.setData({
      input1: e.detail.value
    })
  },
  //获取用户输入的值b
  inputb: function (e) {
    this.setData({
      input2: e.detail.value
    })
  },
  // 拿到两个输入值以后求和
  sum: function (e) {
    var a = parseInt(this.data.input1);
    var b = parseInt(this.data.input2);
    // 求和
    var sumResult = a + b
    this.setData({
      // 把结果赋值到sum标签上
      result: sumResult
    })
  }
})