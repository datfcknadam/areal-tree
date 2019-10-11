<?php
use PHPUnit\Framework\TestCase;
require_once 'tree.php';

final class treeTest extends TestCase {
  const DIR_TEST = "    ├── static
  │   ├── a_lorem
  │   │   └── ipsum
  │   ├── css
  │   ├── html
  │   ├── js
  │   └── z_lorem
  │       └── ipsum
  └── zline
      └── lorem
          └── ipsum
";
const FULL_TEST = "   ├── main_test.go(1.82 KB)
├── project
│   ├── file.txt(19.00 B)
│   └── gopher.png(68.72 KB)
├── static
│   ├── a_lorem
│   │   ├── dolor.txt(0.00 B)
│   │   ├── gopher.png(68.72 KB)
│   │   └── ipsum
│   │       └── gopher.png(68.72 KB)
│   ├── css
│   │   └── body.css(28.00 B)
│   ├── empty.txt(0.00 B)
│   ├── html
│   │   └── index.html(57.00 B)
│   ├── js
│   │   └── site.js(10.00 B)
│   └── z_lorem
│       ├── dolor.txt(0.00 B)
│       ├── gopher.png(68.72 KB)
│       └── ipsum
│           └── gopher.png(68.72 KB)
├── zline
│   ├── empty.txt(0.00 B)
│   └── lorem
│       ├── dolor.txt(0.00 B)
│       ├── gopher.png(68.72 KB)
│       └── ipsum
│           └── gopher.png(68.72 KB)
└── zzfile.txt(0.00 B)
";

  protected function setUp() {
    $this->tree = new Tree();
  }

  protected function tearDown(){
    $this->tree = NULL;
  }

  public function addDataProvider() {
    return [
      ["testdata", NULL, self::DIR_TEST],
      ["testdata", "-f", self::FULL_TEST]
    ];
  }

  /**
   * @dataProvider addDataProvider
   */
  public function testTree($a, $b, $expected) {
    $result = $this->tree->output($a, $b);
    $this->assertSame($expected, $result);
  }
}
?>
