<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\Arrays\ArrayIndentSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Arrays\DisallowLongArraySyntaxSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting\SpaceAfterCastSniff;
use PHP_CodeSniffer\Standards\PSR12\Sniffs\Files\FileHeaderSniff;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\Classes\PropertyDeclarationSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\CastSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\FunctionSpacingSniff;
use PhpCsFixer\Fixer\ArrayNotation\NoWhitespaceBeforeCommaInArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\WhitespaceAfterCommaInArrayFixer;
use PhpCsFixer\Fixer\Basic\BracesFixer;
use PhpCsFixer\Fixer\Basic\EncodingFixer;
use PhpCsFixer\Fixer\Casing\ConstantCaseFixer;
use PhpCsFixer\Fixer\Casing\LowercaseKeywordsFixer;
use PhpCsFixer\Fixer\CastNotation\LowercaseCastFixer;
use PhpCsFixer\Fixer\CastNotation\ShortScalarCastFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassDefinitionFixer;
use PhpCsFixer\Fixer\ClassNotation\NoBlankLinesAfterClassOpeningFixer;
use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\Comment\NoTrailingWhitespaceInCommentFixer;
use PhpCsFixer\Fixer\ControlStructure\ElseifFixer;
use PhpCsFixer\Fixer\ControlStructure\NoBreakCommentFixer;
use PhpCsFixer\Fixer\ControlStructure\SwitchCaseSemicolonToColonFixer;
use PhpCsFixer\Fixer\ControlStructure\SwitchCaseSpaceFixer;
use PhpCsFixer\Fixer\FunctionNotation\FunctionDeclarationFixer;
use PhpCsFixer\Fixer\FunctionNotation\MethodArgumentSpaceFixer;
use PhpCsFixer\Fixer\FunctionNotation\NoSpacesAfterFunctionNameFixer;
use PhpCsFixer\Fixer\FunctionNotation\ReturnTypeDeclarationFixer;
use PhpCsFixer\Fixer\Import\NoLeadingImportSlashFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\Import\SingleLineAfterImportsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\DeclareEqualNormalizeFixer;
use PhpCsFixer\Fixer\NamespaceNotation\BlankLineAfterNamespaceFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\NewWithBracesFixer;
use PhpCsFixer\Fixer\Operator\TernaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer;
use PhpCsFixer\Fixer\PhpTag\FullOpeningTagFixer;
use PhpCsFixer\Fixer\PhpTag\NoClosingTagFixer;
use PhpCsFixer\Fixer\Semicolon\NoSinglelineWhitespaceBeforeSemicolonsFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Whitespace\IndentationTypeFixer;
use PhpCsFixer\Fixer\Whitespace\LineEndingFixer;
use PhpCsFixer\Fixer\Whitespace\NoSpacesInsideParenthesisFixer;
use PhpCsFixer\Fixer\Whitespace\NoTrailingWhitespaceFixer;
use PhpCsFixer\Fixer\Whitespace\SingleBlankLineAtEofFixer;
use SlevomatCodingStandard\Sniffs\Arrays\DisallowImplicitArrayCreationSniff;
use SlevomatCodingStandard\Sniffs\Arrays\MultiLineArrayEndBracketPlacementSniff;
use SlevomatCodingStandard\Sniffs\Arrays\SingleLineArrayWhitespaceSniff;
use SlevomatCodingStandard\Sniffs\Arrays\TrailingArrayCommaSniff;
use SlevomatCodingStandard\Sniffs\Classes\ClassConstantVisibilitySniff;
use SlevomatCodingStandard\Sniffs\Classes\ClassMemberSpacingSniff;
use SlevomatCodingStandard\Sniffs\Classes\ClassStructureSniff;
use SlevomatCodingStandard\Sniffs\Classes\ConstantSpacingSniff;
use SlevomatCodingStandard\Sniffs\Classes\ModernClassNameReferenceSniff;
use SlevomatCodingStandard\Sniffs\Classes\ParentCallSpacingSniff;
use SlevomatCodingStandard\Sniffs\Classes\PropertySpacingSniff;
use SlevomatCodingStandard\Sniffs\Classes\RequireConstructorPropertyPromotionSniff;
use SlevomatCodingStandard\Sniffs\Classes\RequireMultiLineMethodSignatureSniff;
use SlevomatCodingStandard\Sniffs\Classes\TraitUseDeclarationSniff;
use SlevomatCodingStandard\Sniffs\Classes\UselessLateStaticBindingSniff;
use SlevomatCodingStandard\Sniffs\Commenting\DocCommentSpacingSniff;
use SlevomatCodingStandard\Sniffs\Commenting\ForbiddenAnnotationsSniff;
use SlevomatCodingStandard\Sniffs\Commenting\InlineDocCommentDeclarationSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\DisallowContinueWithoutIntegerOperandInSwitchSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\EarlyExitSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\JumpStatementsSpacingSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\LanguageConstructWithParenthesesSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\RequireNullCoalesceEqualOperatorSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\RequireNullCoalesceOperatorSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\RequireNullSafeObjectOperatorSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\RequireShortTernaryOperatorSniff;
use SlevomatCodingStandard\Sniffs\Exceptions\DeadCatchSniff;
use SlevomatCodingStandard\Sniffs\Exceptions\RequireNonCapturingCatchSniff;
use SlevomatCodingStandard\Sniffs\Functions\ArrowFunctionDeclarationSniff;
use SlevomatCodingStandard\Sniffs\Functions\RequireArrowFunctionSniff;
use SlevomatCodingStandard\Sniffs\Functions\RequireTrailingCommaInCallSniff;
use SlevomatCodingStandard\Sniffs\Functions\RequireTrailingCommaInDeclarationSniff;
use SlevomatCodingStandard\Sniffs\Functions\StaticClosureSniff;
use SlevomatCodingStandard\Sniffs\Functions\StrictCallSniff;
use SlevomatCodingStandard\Sniffs\Functions\UnusedInheritedVariablePassedToClosureSniff;
use SlevomatCodingStandard\Sniffs\Functions\UnusedParameterSniff;
use SlevomatCodingStandard\Sniffs\Functions\UselessParameterDefaultValueSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\DisallowGroupUseSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\MultipleUsesPerLineSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\NamespaceDeclarationSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\NamespaceSpacingSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\ReferenceUsedNamesOnlySniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UnusedUsesSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UseFromSameNamespaceSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UselessAliasSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UseSpacingSniff;
use SlevomatCodingStandard\Sniffs\Numbers\RequireNumericLiteralSeparatorSniff;
use SlevomatCodingStandard\Sniffs\Operators\DisallowEqualOperatorsSniff;
use SlevomatCodingStandard\Sniffs\PHP\DisallowDirectMagicInvokeCallSniff;
use SlevomatCodingStandard\Sniffs\PHP\OptimizedFunctionsWithoutUnpackingSniff;
use SlevomatCodingStandard\Sniffs\PHP\ShortListSniff;
use SlevomatCodingStandard\Sniffs\PHP\TypeCastSniff;
use SlevomatCodingStandard\Sniffs\PHP\UselessParenthesesSniff;
use SlevomatCodingStandard\Sniffs\PHP\UselessSemicolonSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\DisallowArrayTypeHintSyntaxSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\LongTypeHintsSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\NullableTypeForNullDefaultValueSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\NullTypeHintOnLastPositionSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSpacingSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\PropertyTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\UnionTypeHintFormatSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\UselessConstantTypeHintSniff;
use SlevomatCodingStandard\Sniffs\Variables\DisallowSuperGlobalVariableSniff;
use SlevomatCodingStandard\Sniffs\Variables\DuplicateAssignmentToVariableSniff;
use SlevomatCodingStandard\Sniffs\Variables\UnusedVariableSniff;
use SlevomatCodingStandard\Sniffs\Variables\UselessVariableSniff;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ECSConfig $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $maxLineLength = 120;

    // PSR-12
    $services->set(EncodingFixer::class);
    $services->set(FullOpeningTagFixer::class);
    $services->set(BlankLineAfterNamespaceFixer::class);
    $services->set(ClassDefinitionFixer::class);
    $services->set(ConstantCaseFixer::class);
    $services->set(ElseifFixer::class);
    $services->set(FunctionDeclarationFixer::class);
    $services->set(IndentationTypeFixer::class);
    $services->set(LineEndingFixer::class);
    $services->set(LowercaseKeywordsFixer::class);
    $services->set(MethodArgumentSpaceFixer::class)
        ->call('configure', [
            ['on_multiline' => 'ensure_fully_multiline'],
        ]);
    $services->set(NoBreakCommentFixer::class);
    $services->set(NoClosingTagFixer::class);
    $services->set(NoSpacesAfterFunctionNameFixer::class);
    $services->set(NoSpacesInsideParenthesisFixer::class);
    $services->set(NoTrailingWhitespaceFixer::class);
    $services->set(NoTrailingWhitespaceInCommentFixer::class);
    $services->set(SingleBlankLineAtEofFixer::class);
    $services->set(SingleLineAfterImportsFixer::class);
    $services->set(SwitchCaseSemicolonToColonFixer::class);
    $services->set(SwitchCaseSpaceFixer::class);
    $services->set(LowercaseCastFixer::class);
    $services->set(ShortScalarCastFixer::class);
    $services->set(BlankLineAfterOpeningTagFixer::class);
    $services->set(NoLeadingImportSlashFixer::class);
    $services->set(OrderedImportsFixer::class)
        ->call('configure', [
            [
                'imports_order' => [
                    'class',
                    'function',
                    'const',
                ],
            ],
        ]);
    $services->set(DeclareEqualNormalizeFixer::class)
        ->call('configure', [
            ['space' => 'none'],
        ]);
    $services->set(NewWithBracesFixer::class);
    $services->set(BracesFixer::class)
        ->call('configure', [
            [
                'allow_single_line_closure' => false,
                'position_after_functions_and_oop_constructs' => 'next',
                'position_after_control_structures' => 'same',
                'position_after_anonymous_constructs' => 'same',
            ],
        ]);
    $services->set(NoBlankLinesAfterClassOpeningFixer::class);
    $services->set(VisibilityRequiredFixer::class)
        ->call('configure', [
            [
                'elements' => [
                    'const',
                    'method',
                    'property',
                ],
            ],
        ]);
    $services->set(BinaryOperatorSpacesFixer::class);
    $services->set(TernaryOperatorSpacesFixer::class);
    $services->set(UnaryOperatorSpacesFixer::class);
    $services->set(ReturnTypeDeclarationFixer::class);
    $services->set(ConcatSpaceFixer::class)
        ->call('configure', [
            [
                'spacing' => 'one',
            ],
        ]);
    $services->set(NoSinglelineWhitespaceBeforeSemicolonsFixer::class);
    $services->set(NoWhitespaceBeforeCommaInArrayFixer::class);
    $services->set(WhitespaceAfterCommaInArrayFixer::class);

    // Custom PHP_CodeSniffer
    $services->set(FileHeaderSniff::class);
    $services->set(DisallowLongArraySyntaxSniff::class);
    $services->set(ArrayIndentSniff::class);
    $services->set(CastSpacingSniff::class);
    $services->set(SpaceAfterCastSniff::class);
    $services->set(LineLengthSniff::class)
        ->property('absoluteLineLimit', $maxLineLength);
    $services->set(FunctionSpacingSniff::class)
        ->property('spacing', 1)
        ->property('spacingBeforeFirst', 0)
        ->property('spacingAfterLast', 0);

    // Custom PhpCsFixer
    $services->set(DeclareStrictTypesFixer::class);

    // Custom Slevomat
    $services->set(UselessConstantTypeHintSniff::class);
    $services->set(UnionTypeHintFormatSniff::class)
        ->property('withSpaces', 'no')
        ->property('shortNullable', 'yes')
        ->property('nullPosition', 'last');
    $services->set(RequireNonCapturingCatchSniff::class);
    $services->set(ClassStructureSniff::class)
        ->property('groups', [
            'uses',

            'enum cases',

            'public constants',
            'protected constants',
            'private constants',

            'public static properties',
            'protected static properties',
            'private static properties',

            'public properties',
            'protected properties',
            'private properties',

            'constructor',
            'static constructors',
            'destructor',

            'public final methods',
            'public static final methods',
            'public abstract methods',
            'public static abstract methods',
            'public static methods',
            'public methods',

            'protected final methods',
            'protected static final methods',
            'protected abstract methods',
            'protected static abstract methods',
            'protected static methods',
            'protected methods',

            'private static methods',
            'private methods',

            'magic methods',
        ]);
    $services->set(RequireConstructorPropertyPromotionSniff::class);
    $services->set(UselessLateStaticBindingSniff::class);
    $services->set(DisallowContinueWithoutIntegerOperandInSwitchSniff::class);
    $services->set(StaticClosureSniff::class);

    // Custom Slevomat Cleaning (Dead Code detection)
    $services->set(UnusedInheritedVariablePassedToClosureSniff::class);
    $services->set(UselessParameterDefaultValueSniff::class);
    $services->set(ReferenceUsedNamesOnlySniff::class)
        ->property('searchAnnotations', true);
    $services->set(UnusedUsesSniff::class)
        ->property('searchAnnotations', true);
    $services->set(UseFromSameNamespaceSniff::class);
    $services->set(UselessAliasSniff::class);
    $services->set(OptimizedFunctionsWithoutUnpackingSniff::class);
    $services->set(UselessSemicolonSniff::class);
    $services->set(DisallowSuperGlobalVariableSniff::class);
    $services->set(UnusedVariableSniff::class)
        ->property('ignoreUnusedValuesWhenOnlyKeysAreUsedInForeach', true);
    $services->set(UselessVariableSniff::class);
    $services->set(DeadCatchSniff::class);

    // Custom Slevomat Formatting
    $services->set(MultiLineArrayEndBracketPlacementSniff::class);
    $services->set(SingleLineArrayWhitespaceSniff::class);
    $services->set(TrailingArrayCommaSniff::class);
    $services->set(ClassMemberSpacingSniff::class);
    $services->set(ConstantSpacingSniff::class)
        ->property('minLinesCountBeforeWithComment', 1)
        ->property('maxLinesCountBeforeWithComment', 1)
        ->property('minLinesCountBeforeWithoutComment', 0)
        ->property('maxLinesCountBeforeWithoutComment', 1);
    $services->set(ModernClassNameReferenceSniff::class);
    $services->set(ParentCallSpacingSniff::class);
    $services->set(PropertySpacingSniff::class)
        ->property('minLinesCountBeforeWithComment', 1)
        ->property('maxLinesCountBeforeWithComment', 1)
        ->property('minLinesCountBeforeWithoutComment', 0)
        ->property('maxLinesCountBeforeWithoutComment', 1);
    $services->set(RequireMultiLineMethodSignatureSniff::class)
        ->property('minLineLength', $maxLineLength);
    $services->set(TraitUseDeclarationSniff::class);
    $services->set(JumpStatementsSpacingSniff::class);
    $services->set(LanguageConstructWithParenthesesSniff::class);
    $services->set(ArrowFunctionDeclarationSniff::class)
        ->property('allowMultiLine', true);
    $services->set(RequireTrailingCommaInCallSniff::class);
    $services->set(RequireTrailingCommaInDeclarationSniff::class);
    $services->set(NamespaceDeclarationSniff::class);
    $services->set(NamespaceSpacingSniff::class);
    $services->set(UseSpacingSniff::class);
    $services->set(RequireNumericLiteralSeparatorSniff::class)
        ->property('minDigitsBeforeDecimalPoint', 6);
    $services->set(ShortListSniff::class);
    $services->set(ClassConstantVisibilitySniff::class);
    $services->set(NullableTypeForNullDefaultValueSniff::class);
    $services->set(DisallowGroupUseSniff::class);
    $services->set(PropertyDeclarationSniff::class);

    // New funtional slevomat rules
    $services->set(ParameterTypeHintSniff::class);
    $services->set(PropertyTypeHintSniff::class);
    $services->set(ReturnTypeHintSniff::class);
    $services->set(RequireNonCapturingCatchSniff::class);
    $services->set(DisallowImplicitArrayCreationSniff::class);
    $services->set(RequireNullCoalesceOperatorSniff::class);
    $services->set(RequireNullCoalesceEqualOperatorSniff::class);
    $services->set(EarlyExitSniff::class);
    $services->set(StrictCallSniff::class);
    $services->set(DisallowDirectMagicInvokeCallSniff::class);
    $services->set(DisallowEqualOperatorsSniff::class);

    // New clean slevomat rules
    $services->set(UnusedParameterSniff::class);
    $services->set(UselessParenthesesSniff::class);
    $services->set(DuplicateAssignmentToVariableSniff::class);

    // New formatting slevomat rules https://github.com/slevomat/coding-standard#formatting---rules-for-consistent-code-looks
    $services->set(RequireNullSafeObjectOperatorSniff::class);
    $services->set(RequireShortTernaryOperatorSniff::class);
    $services->set(RequireArrowFunctionSniff::class);
    $services->set(DisallowArrayTypeHintSyntaxSniff::class);
    $services->set(LongTypeHintsSniff::class);
    $services->set(NullTypeHintOnLastPositionSniff::class);
    $services->set(TypeCastSniff::class);
    $services->set(ParameterTypeHintSpacingSniff::class);
    // $services->set(FullyQualifiedGlobalConstantsSniff::class);
    // $services->set(FullyQualifiedGlobalFunctionsSniff::class);
    $services->set(MultipleUsesPerLineSniff::class);
    $services->set(ForbiddenAnnotationsSniff::class)
        ->property('forbiddenAnnotations', ['@author', '@created', '@version', '@package', '@copyright']);
    $services->set(DocCommentSpacingSniff::class)
        ->property('annotationsGroups', [
            '@var',
            '@param',
            '@return',
        ]);
    $services->set(InlineDocCommentDeclarationSniff::class)
        ->property('allowDocCommentAboveReturn', true)
        ->property('allowAboveNonAssignment', true);

    $containerConfigurator
        ->parameters()
        ->set(Option::PARALLEL, true);
};
