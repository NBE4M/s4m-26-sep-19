<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Tests\Helper;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Output\StreamOutput;

/**
 * @group time-sensitive
 */
class ProgressBarTest extends TestCase
{
    public function testMultipleStart()
    {
        $bar = new ProgressBar($output = $this->getOutputStream());
        $bar->start();
        $bar->advance();
        $bar->start();

        rewind($output->getStream());
        $this->assertEquals(
            '    0 [>---------------------------]'.
            $this->generateOutput('    1 [->--------------------------]').
            $this->generateOutput('    0 [>---------------------------]'),
            stream_get_contents($output->getStream())
        );
    }

    public function testAdvance()
    {
        $bar = new ProgressBar($output = $this->getOutputStream());
        $bar->start();
        $bar->advance();

        rewind($output->getStream());
        $this->assertEquals(
            '    0 [>---------------------------]'.
            $this->generateOutput('    1 [->--------------------------]'),
            stream_get_contents($output->getStream())
        );
    }

    public function testAdvanceWithStep()
    {
        $bar = new ProgressBar($output = $this->getOutputStream());
        $bar->start();
        $bar->advance(5);

        rewind($output->getStream());
        $this->assertEquals(
            '    0 [>---------------------------]'.
            $this->generateOutput('    5 [----->----------------------]'),
            stream_get_contents($output->getStream())
        );
    }

    public function testAdvanceMultipleTimes()
    {
        $bar = new ProgressBar($output = $this->getOutputStream());
        $bar->start();
        $bar->advance(3);
        $bar->advance(2);

        rewind($output->getStream());
        $this->assertEquals(
            '    0 [>---------------------------]'.
            $this->generateOutput('    3 [--->------------------------]').
            $this->generateOutput('    5 [----->----------------------]'),
            stream_get_contents($output->getStream())
        );
    }

    public function testAdvanceOverMax()
    {
        $bar = new ProgressBar($output = $this->getOutputStream(), 10);
        $bar->setProgress(9);
        $bar->advance();
        $bar->advance();

        rewind($output->getStream());
        $this->assertEquals(
            '  9/10 [=========================>--]  90%'.
            $this->generateOutput(' 10/10 [============================] 100%').
            $this->generateOutput(' 11/11 [============================] 100%'),
            stream_get_contents($output->getStream())
        );
    }

    public function testRegress()
    {
        $bar = new ProgressBar($output = $this->getOutputStream());
        $bar->start();
        $bar->advance();
        $bar->advance();
        $bar->advance(-1);

        rewind($output->getStream());
        $this->assertEquals(
            '    0 [>---------------------------]'.
            $this->generateOutput('    1 [->--------------------------]').
            $this->generateOutput('    2 [-->-------------------------]').
            $this->generateOutput('    1 [->--------------------------]'),
            stream_get_contents($output->getStream())
        );
    }

    public function testRegressWithStep()
    {
        $bar = new ProgressBar($output = $this->getOutputStream());
        $bar->start();
        $bar->advance(4);
        $bar->advance(4);
        $bar->advance(-2);

        rewind($output->getStream());
        $this->assertEquals(
            '    0 [>---------------------------]'.
            $this->generateOutput('    4 [---->-----------------------]').
            $this->generateOutput('    8 [-------->-------------------]').
            $this->generateOutput('    6 [------>---------------------]'),
            stream_get_contents($output->getStream())
        );
    }

    public function testRegressMultipleTimes()
    {
        $bar = new ProgressBar($output = $this->getOutputStream());
        $bar->start();
        $bar->advance(3);
        $bar->advance(3);
        $bar->advance(-1);
        $bar->advance(-2);

        rewind($output->getStream());
        $this->assertEquals(
            '    0 [>---------------------------]'.
            $this->generateOutput('    3 [--->------------------------]').
            $this->generateOutput('    6 [------>---------------------]').
            $this->generateOutput('    5 [----->----------------------]').
            $this->generateOutput('    3 [--->------------------------]'),
            stream_get_contents($output->getStream())
        );
    }

    public function testRegressBelowMin()
    {
        $bar = new ProgressBar($output = $this->getOutputStream(), 10);
        $bar->setProgress(1);
        $bar->advance(-1);
        $bar->advance(-1);

        rewind($output->getStream());
        $this->assertEquals(
            '  1/10 [==>-------------------------]  10%'.
            $this->generateOutput('  0/10 [>---------------------------]   0%'),
            stream_get_contents($output->getStream())
        );
    }

    public function testFormat()
    {
        $expected =
            '  0/10 [>---------------------------]   0%'.
            $this->generateOutput(' 10/10 [============================] 100%').
            $this->generateOutput(' 10/10 [============================] 100%')
        ;

        // max in construct, no format
        $bar = new ProgressBar($output = $this->getOutputStream(), 10);
        $bar->start();
        $bar->advance(10);
        $bar->finish();

        rewind($output->getStream());
        $this->assertEquals($expected, stream_get_contents($output->getStream()));

        // max in start, no format
        $bar = new ProgressBar($output = $this->getOutputStream());
        $bar->start(10);
        $bar->advance(10);
        $bar->finish();

        rewind($output->getStream());
        $this->assertEquals($expected, stream_get_contents($output->getStream()));

        // max in construct, explicit format before
        $bar = new ProgressBar($output = $this->getOutputStream(), 10);
        $bar->setFormat('normal');
        $bar->start();
        $bar->advance(10);
        $bar->finish();

        rewind($output->getStream());
        $this->assertEquals($expected, stream_get_contents($output->getStream()));

        // max in start, explicit format before
        $bar = new ProgressBar($output = $this->getOutputStream());
        $bar->setFormat('normal');
        $bar->start(10);
        $bar->advance(10);
        $bar->finish();

        rewind($output->getStream());
        $this->assertEquals($expected, stream_get_contents($output->getStream()));
    }

    public function testCustomizations()
    {
        $bar = new ProgressBar($output = $this->getOutputStream(), 10);
        $bar->setBarWidth(10);
        $bar->setBarCharacter('_');
        $bar->setEmptyBarCharacter(' ');
        $bar->setProgressCharacter('/');
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%%');
        $bar->start();
        $bar->advance();

        rewind($output->getStream());
        $this->assertEquals(
            '  0/10 [/         ]   0%'.
            $this->generateOutput('  1/10 [_/        ]  10%'),
            stream_get_contents($output->getStream())
        );
    }

    public function testDisplayWithoutStart()
    {
        $bar = new ProgressBar($output = $this->getOutputStream(), 50);
        $bar->display();

        rewind($output->getStream());
        $this->assertEquals(
            '  0/50 [>---------------------------]   0%',
            stream_get_contents($output->getStream())
        );
    }

    public function testDisplayWithQuietVerbosity()
    {
        $bar = new ProgressBar($output = $this->getOutputStream(true, StreamOutput::VERBOSITY_QUIET), 50);
        $bar->display();

        rewind($output->getStream());
        $this->assertEquals(
            '',
            stream_get_contents($output->getStream())
        );
    }

    public function testFinishWithoutStart()
    {
        $bar = new ProgressBar($output = $this->getOutputStream(), 50);
        $bar->finish();

        rewind($output->getStream());
        $this->assertEquals(
            ' 50/50 [============================] 100%',
            stream_get_contents($output->getStream())
        );
    }

    public function testPercent()
    {
        $bar = new ProgressBar($output = $this->getOutputStream(), 50);
        $bar->start();
        $bar->display();
        $bar->advance();
        $bar->advance();

        rewind($output->getStream());
        $this->assertEquals(
            '  0/50 [>---------------------------]   0%'.
            $this->generateOutput('  0/50 [>---------------------------]   0%').
            $this->generateOutput('  1/50 [>---------------------------]   2%').
            $this->generateOutput('  2/50 [=>--------------------------]   4%'),
            stream_get_contents($output->getStream())
        );
    }

    public function testOverwriteWithShorterLine()
    {
        $bar = new ProgressBar($output = $this->getOutputStream(), 50);
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%%');
        $bar->start();
        $bar->display();
        $bar->advance();

        // set shorter format
        $bar->setFormat(' %current%/%max% [%bar%]');
        $bar->advance();

        rewind($output->getStream());
        $this->assertEquals(
            '  0/50 [>---------------------------]   0%'.
            $this->generateOutput('  0/50 [>---------------------------]   0%').
            $this->generateOutput('  1/50 [>---------------------------]   2%').
            $this->generateOutput('  2/50 [=>--------------------------]'),
            stream_get_contents($output->getStream())
        );
    }

    public function testStartWithMax()
    {
        $bar = new ProgressBar($output = $this->getOutputStream());
        $bar->setFormat('%current%/%max% [%bar%]');
        $bar->start(50);
        $bar->advance();

        rewind($output->getStream());
        $this->assertEquals(
            ' 0/50 [>---------------------------]'.
            $this->generateOutput(' 1/50 [>---------------------------]'),
            stream_get_contents($output->getStream())
        );
    }

    public function testSetCurrentProgress()
    {
        $bar = new ProgressBar($output = $this->getOutputStream(), 50);
        $bar->start();
        $bar->display();
        $bar->advance();
        $bar->setProgress(15);
        $bar->setProgress(25);

        rewind($output->getStream());
        $this->assertEquals(
            '  0/50 [>---------------------------]   0%'.
            $this->generateOutput('  0/50 [>---------------------------]   0%').
            $this->generateOutput('  1/50 [>---------------------------]   2%').
            $this->generateOutput(' 15/50 [========>-------------------]  30%').
            $this->generateOutput(' 25/50 [==============>-------------]  50%'),
            stream_get_contents($output->getStream())
        );
    }

    public function testSetCurrentBeforeStarting()
    {
        $bar = new ProgressBar($this->getOutputStream());
        $bar->setProgress(15);
        $this->assertNotNull($bar->getStartTime());
    }

    public function testRedrawFrequency()
    {
        $bar = $this->getMockBuilder('Symfony\Component\Console\Helper\ProgressBar')->setMethods(array('display'))->setConstructorArgs(array($this->getOutputStream(), 6))->getMock();
        $bar->expects($this->exactly(4))->method('display');

        $bar->setRedrawFrequency(2);
        $bar->start();
        $bar->setProgress(1);
        $bar->advance(2);
        $bar->advance(2);
        $bar->advance(1);
    }

    public function testRedrawFrequencyIsAtLeastOneIfZeroGiven()
    {
        $bar = $this->getMockBuilder('Symfony\Component\Console\Helper\ProgressBar')->setMethods(array('display'))->setConstructorArgs(array($this->getOutputStream()))->getMock();

        $bar->expects($this->exactly(2))->method('display');
        $bar->setRedrawFrequency(0);
        $bar->start();
        $bar->advance();
    }

    public function testRedrawFrequencyIsAtLeastOneIfSmallerOneGiven()
    {
        $bar = $this->getMockBuilder('Symfony\Component\Console\Helper\ProgressBar')->setMethods(array('display'))->setConstructorArgs(array($this->getOutputStream()))->getMock();

        $bar->expects($this->exactly(2))->method('display');
        $bar->setRedrawFrequency(0.9);
        $bar->start();
        $bar->advance();
    }

    public function testMultiByteSupport()
    {
        $bar = new ProgressBar($output = $this->getOutputStream());
        $bar->start();
        $bar->setBarCharacter('■');
        $bar->advance(3);

        rewind($output->getStream());
        $this->assertEquals(
            '    0 [>---------------------------]'.
            $this->generateOutput('    3 [■■■>------------------------]'),
            stream_get_contents($output->getStream())
        );
    }

    public function testClear()
    {
        $bar = new ProgressBar($output = $this->getOutputStream(), 50);
        $bar->start();
        $bar->setProgress(25);
        $bar->clear();

        rewind($output->getStream());
        $this->assertEquals(
            '  0/50 [>---------------------------]   0%'.
            $this->generateOutput(' 25/50 [==============>-------------]  50%').
            $this->generateOutput(''),
            stream_get_contents($output->getStream())
        );
    }

    public function testPercentNotHundredBeforeComplete()
    {
        $bar = new ProgressBar($output = $this->getOutputStream(), 200);
        $bar->start();
        $bar->display();
        $bar->advance(199);
        $bar->advance();

        rewind($output->getStream());
        $this->assertEquals(
            '   0/200 [>---------------------------]   0%'.
            $this->generateOutput('   0/200 [>---------------------------]   0%').
            $this->generateOutput(' 199/200 [===========================>]  99%').
            $this->generateOutput(' 200/200 [============================] 100%'),
            stream_get_contents($output->getStream())
        );
    }

    public function testNonDecoratedOutput()
    {
        $bar = new ProgressBar($output = $this->getOutputStream(false), 200);
        $bar->start();

        for ($i = 0; $i < 200; ++$i) {
            $bar->advance();
        }

        $bar->finish();

        rewind($output->getStream());
        $this->assertEquals(
            '   0/200 [>---------------------------]   0%'.PHP_EOL.
            '  20/200 [==>-------------------------]  10%'.PHP_EOL.
            '  40/200 [=====>----------------------]  20%'.PHP_EOL.
            '  60/200 [========>-------------------]  30%'.PHP_EOL.
            '  80/200 [===========>----------------]  40%'.PHP_EOL.
            ' 100/200 [==============>-------------]  50%'.PHP_EOL.
            ' 120/200 [================>-----------]  60%'.PHP_EOL.
            ' 140/200 [===================>--------]  70%'.PHP_EOL.
            ' 160/200 [======================>-----]  80%'.PHP_EOL.
            ' 180/200 [=========================>--]  90%'.PHP_EOL.
            ' 200/200 [============================] 100%',
            stream_get_contents($output->getStream())
        );
    }

    public function testNonDecoratedOutputWithClear()
    {
        $bar = new ProgressBar($output = $this->getOutputStream(false), 50);
        $bar->start();
        $bar->setProgress(25);
        $bar->clear();
        $bar->setProgress(50);
        $bar->finish();

        rewind($output->getStream());
        $this->assertEquals(
            '  0/50 [>---------------------------]   0%'.PHP_EOL.
            ' 25/50 [==============>-------------]  50%'.PHP_EOL.
            ' 50/50 [============================] 100%',
            stream_get_contents($output->getStream())
        );
    }

    public function testNonDecoratedOutputWithoutMax()
    {
        $bar = new ProgressBar($output = $this->getOutputStream(false));
        $bar->start();
        $bar->advance();

        rewind($output->getStream());
        $this->assertEquals(
            '    0 [>---------------------------]'.PHP_EOL.
            '    1 [->--------------------------]',
            stream_get_contents($output->getStream())
        );
    }

    public function testParallelBars()
    {
        $output = $this->getOutputStream();
        $bar1 = new ProgressBar($output, 2);
        $bar2 = new ProgressBar($output, 3);
        $bar2->setProgressCharacter('#');
        $bar3 = new ProgressBar($output);

        $bar1->start();
        $output->write("\n");
        $bar2->start();
        $output->write("\n");
        $bar3->start();

        for ($i = 1; $i <= 3; ++$i) {
            // up two lines
            $output->write("\033[2A");
            if ($i <= 2) {
                $bar1->advance();
            }
            $output->write("\n");
            $bar2->advance();
            $output->write("\n");
            $bar3->advance();
        }
        $output->write("\033[2A");
        $output->write("\n");
        $output->write("\n");
        $bar3->finish();

        rewind($output->getStream());
        $this->assertEquals(
            ' 0/2 [>---------------------------]   0%'."\n".
            ' 0/3 [#---------------------------]   0%'."\n".
            rtrim('    0 [>---------------------------]').

            "\033[2A".
            $this->generateOutput(' 1/2 [==============>-------------]  50%')."\n".
            $this->generateOutput(' 1/3 [=========#------------------]  33%')."\n".
            rtrim($this->generateOutput('    1 [->--------------------------]')).

            "\033[2A".
            $this->generateOutput(' 2/2 [============================] 100%')."\n".
            $this->generateOutput(' 2/3 [==================#---------]  66%')."\n".
            rtrim($this->generateOutput('    2 [-->-------------------------]')).

            "\033[2A".
            "\n".
            $this->generateOutput(' 3/3 [============================] 100%')."\n".
            rtrim($this->generateOutput('    3 [--->------------------------]')).

            "\033[2A".
            "\n".
            "\n".
            rtrim($this->generateOutput('    3 [============================]')),
            stream_get_contents($output->getStream())
        );
    }

    public function testWithoutMax()
    {
        $output = $this->getOutputStream();

        $bar = new ProgressBar($output);
        $bar->start();
        $bar->advance();
        $bar->advance();
        $bar->advance();
        $bar->finish();

        rewind($output->getStream());
        $this->assertEquals(
            rtrim('    0 [>---------------------------]').
            rtrim($this->generateOutput('    1 [->--------------------------]')).
            rtrim($this->generateOutput('    2 [-->-------------------------]')).
            rtrim($this->generateOutput('    3 [--->------------------------]')).
            rtrim($this->generateOutput('    3 [============================]')),
            stream_get_contents($output->getStream())
        );
    }

    public function testWithSmallScreen()
    {
        $output = $this->getOutputStream();

        $bar = new ProgressBar($output);
        putenv('COLUMNS=12');
        $bar->start();
        $bar->advance();
        putenv('COLUMNS=120');

        rewind($output->getStream());
        $this->assertEquals(
            '    0 [>---]'.
            $this->generateOutput('    1 [->--]'),
            stream_get_contents($output->getStream())
        );
    }

    public function testAddingPlaceholderFormatter()
    {
        ProgressBar::setPlaceholderFormatterDefinition('remaining_steps', function (ProgressBar $bar) {
            return $bar->getMaxSteps() - $bar->getProgress();
        });
        $bar = new ProgressBar($output = $this->getOutputStream(), 3);
        $bar->setFormat(' %remaining_steps% [%bar%]');

        $bar->start();
        $bar->advance();
        $bar->finish();

        rewind($output->getStream());
        $this->assertEquals(
            ' 3 [>---------------------------]'.
            $this->generateOutput(' 2 [=========>------------------]').
            $this->generateOutput(' 0 [============================]'),
            stream_get_contents($output->getStream())
        );
    }

    public function testMultilineFormat()
    {
        $bar = new ProgressBar($output = $this->getOutputStream(), 3);
        $bar->setFormat("%bar%\nfoobar");

        $bar->start();
        $bar->advance();
        $bar->clear();
        $bar->finish();

        rewind($output->getStream());
        $this->assertEquals(
            ">---------------------------\nfoobar".
            $this->generateOutput("=========>------------------\nfoobar").
            "\x0D\x1B[2K\x1B[1A\x1B[2K".
            $this->generateOutput("============================\nfoobar"),
            stream_get_contents($output->getStream())
        );
    }

    public function testAnsiColorsAndEmojis()
    {
        putenv('COLUMNS=156');

        $bar = new ProgressBar($output = $this->getOutputStream(), 15);
        ProgressBar::setPlaceholderFormatterDefinition('memory', function (ProgressBar $bar) {
            static $i = 0;
            $mem = 100000 * $i;
            $colors = $i++ ? '41;37' : '44;37';

            return "\033[".$colors.'m '.Helper::formatMemory($mem)." \033[0m";
        });
        $bar->setFormat(" \033[44;37m %title:-37s% \033[0m\n %current%/%max% %bar% %percent:3s%%\n 🏁  %remaining:-10s% %memory:37s%");
        $bar->setBarCharacter($done = "\033[32m●\033[0m");
        $bar->setEmptyBarCharacter($empty = "\033[31m●\033[0m");
        $bar->setProgressCharacter($progress = "\033[32m➤ \033[0m");

        $bar->setMessage('Starting the demo... fingers crossed', 'title');
        $bar->start();

        rewind($output->getStream());
        $this->assertEquals(
            " \033[44;37m Starting the demo... fingers crossed  \033[0m\n".
            '  0/15 '.$progress.str_repeat($empty, 26)."   0%\n".
            " \xf0\x9f\x8f\x81  < 1 sec                        \033[44;37m 0 B \033[0m",
            stream_get_contents($output->getStream())
        );
        ftruncate($output->getStream(), 0);
        rewind($output->getStream());

        $bar->setMessage('Looks good to me...', 'title');
        $bar->advance(4);

        rewind($output->getStream());
        $this->assertEquals(
            $this->generateOutput(
                " \033[44;37m Looks good to me...                   \033[0m\n".
                '  4/15 '.str_repeat($done, 7).$progress.str_repeat($empty, 19)."  26%\n".
                " \xf0\x9f\x8f\x81  < 1 sec                     \033[41;37m 97 KiB \033[0m"
            ),
            stream_get_contents($output->getStream())
        );
        ftruncate($output->getStream(), 0);
        rewind($output->getStream());

        $bar->setMessage('Thanks, bye', 'title');
        $bar->finish();

        rewind($output->getStream());
        $this->assertEquals(
            $this->generateOutput(
                " \033[44;37m Thanks, bye                           \033[0m\n".
                ' 15/15 '.str_repeat($done, 28)." 100%\n".
                " \xf0\x9f\x8f\x81  < 1 sec                    \033[41;37m 195 KiB \033[0m"
            ),
            stream_get_contents($output->getStream())
        );
        putenv('COLUMNS=120');
    }

    public function testSetFormat()
    {
        $bar = new ProgressBar($output = $this->getOutputStream());
        $bar->setFormat('normal');
        $bar->start();
        rewind($output->getStream());
        $this->assertEquals(
            '    0 [>---------------------------]',
            stream_get_contents($output->getStream())
        );

        $bar = new ProgressBar($output = $this->getOutputStream(), 10);
        $bar->setFormat('normal');
        $bar->start();
        rewind($output->getStream());
        $this->assertEquals(
            '  0/10 [>---------------------------]   0%',
            stream_get_contents($output->getStream())
        );
    }

    /**
     * @dataProvider provideFormat
     */
    public function testFormatsWithoutMax($format)
    {
        $bar = new ProgressBar($output = $this->getOutputStream());
        $bar->setFormat($format);
        $bar->start();

        rewind($output->getStream());
        $this->assertNotEmpty(stream_get_contents($output->getStream()));
    }

    /**
     * Provides each defined format.
     *
     * @return array
     */
    public function provideFormat()
    {
        return array(
            array('normal'),
            array('verbose'),
            array('very_verbose'),
            array('debug'),
        );
    }

    protected function getOutputStream($decorated = true, $verbosity = StreamOutput::VERBOSITY_NORMAL)
    {
        return new StreamOutput(fopen('php://memory', 'r+', false), $verbosity, $decorated);
    }

    protected function generateOutput($expected)
    {
        $count = substr_count($expected, "\n");

        return "\x0D\x1B[2K".($count ? str_repeat("\x1B[1A\x1B[2K", $count) : '').$expected;
    }
}
