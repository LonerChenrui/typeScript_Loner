// 对象
const preson: { name: string, age: number } = { name: 'wang', age: 18 }
// console.log(preson.name);

// 数组
const preson1: number[] = [1]
// console.log(preson1[0]);

// 类
class Loner {
  // constructor() { }
}

const preson2: Loner = new Loner()
// console.log(preson2);

// 函数
const preson3: () => String = () => { return 'Loner' }


// 类型注解
let annotationPreson = 1

function getTotal(one: string, two: string): string {
  return one + two;
}

console.log(getTotal('1', '2'));
