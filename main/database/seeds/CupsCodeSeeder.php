<?php

use Illuminate\Database\Seeder;
use App\Models\Color;
use App\Models\Cup;
use App\Models\Cup_type;

class CupsCodeSeeder extends Seeder
{
    const CODES = [
        905702,
        906469,
        906401,
        903103,
        903104,
        903105,
        903106,
        903107,
        903109,
        903110,
        903111,
        908347,
        908002,
        903112,
        906601,
        903801,
        903802,
        905201,
        905202,
        903113,
        903101,
        908701,
        908001,
        908343,
        908609,
        901201,
        906101,
        903401,
        908812,
        906203,
        904709,
        906901,
        902053,
        902002,
        902003,
        903803,
        903804,
        905703,
        905704,
        905705,
        905706,
        905707,
        905708,
        903402,
        904801,
        904802,
        903403,
        903404,
        903405,
        903406,
        903407,
        903001,
        903002,
        906602,
        903050,
        903611,
        905403,
        903805,
        903806,
        908338,
        908103,
        908104,
        908105,
        908106,
        908101,
        903602,
        904803,
        904501,
        904502,
        905301,
        905302,
        904001,
        901001,
        901002,
        901003,
        902004,
        902005,
        906521,
        906522,
        906903,
        911004,
        911005,
        906406,
        905303,
        905304,
        906001,
        906002,
        906603,
        906604,
        906605,
        906606,
        906610,
        906611,
        906612,
        906302,
        906613,
        906614,
        906490,
        906303,
        906304,
        902006,
        902007,
        902008,
        902009,
        903411,
        903409,
        903412,
        903410,
        906305,
        908702,
        908703,
        905709,
        906102,
        905711,
        908201,
        907001,
        903808,
        905203,
        905204,
        905305,
        905306,
        906480,
        906620,
        908503,
        908704,
        901301,
        903809,
        898003,
        898101,
        898102,
        905713,
        908809,
        906103,
        906306,
        901202,
        906004,
        906006,
        906009,
        906008,
        908432,
        908433,
        906010,
        901203,
        906012,
        906013,
        905714,
        905715,
        903603,
        903811,
        903604,
        903810,
        906621,
        903004,
        903005,
        906851,
        906802,
        906015,
        901241,
        905716,
        905717,
        903812,
        905718,
        905719,
        905207,
        908202,
        908340,
        908203,
        906408,
        906409,
        908406,
        908404,
        908405,
        908407,
        908408,
        908410,
        908409,
        908411,
        908610,
        903006,
        903007,
        903008,
        903009,
        903010,
        902101,
        906411,
        906412,
        906413,
        903416,
        903417,
        904804,
        906018,
        906019,
        906020,
        906021,
        906307,
        906308,
        905721,
        905502,
        905414,
        906108,
        906107,
        906109,
        898002,
        898006,
        898001,
        898001,
        906205,
        906206,
        906414,
        906415,
        903052,
        903053,
        906466,
        903813,
        903814,
        903880,
        905307,
        901204,
        901502,
        901401,
        905725,
        905726,
        906111,
        902051,
        902064,
        903815,
        903816,
        903817,
        903818,
        903418,
        903419,
        903420,
        901104,
        901102,
        901103,
        901107,
        901101,
        901108,
        901109,
        906805,
        906806,
        906904,
        906905,
        906906,
        906907,
        906908,
        911008,
        902201,
        902202,
        902203,
        901206,
        907002,
        907003,
        903421,
        903422,
        907004,
        904805,
        904806,
        904812,
        904807,
        904813,
        904301,
        904302,
        904303,
        901207,
        906312,
        903819,
        903820,
        903821,
        903822,
        903823,
        903824,
        903825,
        906909,
        906627,
        906112,
        906314,
        901208,
        903054,
        903826,
        903827,
        902102,
        902103,
        901209,
        906701,
        901211,
        901212,
        901213,
        901214,
        901215,
        901218,
        901216,
        901217,
        901219,
        903423,
        904809,
        904808,
        906207,
        906208,
        906209,
        903011,
        903424,
        903828,
        903829,
        906844,
        908412,
        905601,
        905602,
        905603,
        905605,
        902010,
        902011,
        902104,
        902105,
        903012,
        906417,
        906418,
        905727,
        906807,
        906808,
        906809,
        906810,
        906811,
        906812,
        906471,
        906113,
        906210,
        908822,
        908811,
        906212,
        906213,
        906214,
        906215,
        906216,
        906217,
        902106,
        902204,
        902205,
        901303,
        898201,
        898241,
        906419,
        906420,
        907201,
        903013,
        903014,
        903015,
        904503,
        904401,
        905729,
        904504,
        904505,
        904506,
        898004,
        898008,
        898110,
        908423,
        908422,
        908424,
        908421,
        908418,
        908420,
        905208,
        905505,
        901304,
        901305,
        902206,
        908427,
        908441,
        902065,
        904101,
        902012,
        902015,
        906813,
        902014,
        906910,
        906911,
        902016,
        902017,
        902018,
        902019,
        902020,
        902021,
        902022,
        902023,
        906814,
        905308,
        903202,
        908315,
        908109,
        905210,
        905213,
        905214,
        905216,
        905309,
        905310,
        911014,
        911013,
        903016,
        902024,
        905415,
        903830,
        903831,
        903832,
        903833,
        903834,
        903017,
        906422,
        906423,
        903875,
        903835,
        903836,
        903837,
        902107,
        907005,
        903425,
        903301,
        908302,
        903838,
        906116,
        903839,
        906624,
        905404,
        905405,
        906475,
        904901,
        908323,
        908322,
        902108,
        902109,
        903840,
        903841,
        903842,
        903843,
        903844,
        903845,
        904508,
        906625,
        907006,
        903020,
        903021,
        906022,
        906023,
        906024,
        906025,
        901220,
        902211,
        911016,
        902212,
        911018,
        911020,
        901221,
        901222,
        901223,
        901224,
        901225,
        902213,
        902110,
        902111,
        902112,
        903426,
        903427,
        902113,
        902114,
        902207,
        902208,
        902209,
        902210,
        902115,
        902214,
        902215,
        903428,
        902025,
        902026,
        906218,
        906219,
        906224,
        906262,
        906220,
        906221,
        906222,
        906223,
        906317,
        906318,
        906815,
        908833,
        906818,
        906225,
        906817,
        906227,
        906226,
        906319,
        906228,
        906229,
        906230,
        906231,
        906320,
        908428,
        908413,
        905723,
        904814,
        904811,
        904402,
        904509,
        902116,
        903846,
        908606,
        908607,
        906501,
        906502,
        906504,
        906505,
        906506,
        906424,
        906337,
        906118,
        906507,
        906508,
        906509,
        906510,
        901004,
        906119,
        904103,
        904511,
        904104,
        904205,
        904206,
        904202,
        904201,
        904902,
        904903,
        904904,
        904905,
        904906,
        904105,
        904106,
        904203,
        904107,
        906467,
        904911,
        904912,
        904913,
        904914,
        906232,
        906233,
        902059,
        902027,
        906823,
        906824,
        906825,
        906826,
        906827,
        906833,
        906834,
        906835,
        906836,
        906828,
        906829,
        906831,
        906832,
        906837,
        904704,
        904705,
        904702,
        906425,
        906426,
        904703,
        901402,
        903605,
        903606,
        906427,
        903429,
        906428,
        906429,
        905406,
        905417,
        906430,
        903024,
        906028,
        906322,
        901228,
        901311,
        903430,
        906702,
        906704,
        906706,
        906709,
        902216,
        901005,
        905002,
        906711,
        906722,
        906724,
        906725,
        906730,
        906736,
        906717,
        906716,
        906738,
        906718,
        906719,
        906763,
        906712,
        906713,
        906714,
        906715,
        906720,
        906721,
        906764,
        906744,
        903847,
        903431,
        903848,
        903501,
        903502,
        903849,
        903850,
        903503,
        903851,
        903852,
        903853,
        903504,
        901312,
        905312,
        905313,
        903854,
        903855,
        903879,
        906765,
        906431,
        905730,
        905731,
        905733,
        905735,
        903025,
        902117,
        902118,
        905736,
        903059,
        903067,
        908426,
        905504,
        901229,
        903026,
        903027,
        903028,
        906484,
        903030,
        903031,
        906432,
        906433,
        906434,
        907202,
        906748,
        905738,
        908507,
        906436,
        906437,
        906438,
        906439,
        906032,
        901230,
        901313,
        901314,
        901007,
        906035,
        906036,
        901231,
        906323,
        901232,
        901233,
        901317,
        905407,
        902119,
        903856,
        903857,
        905606,
        905001,
        905801,
        901234,
        906440,
        906441,
        906442,
        903432,
        898112,
        905740,
        905741,
        905743,
        903033,
        903034,
        903858,
        903035,
        908350,
        903036,
        907007,
        908436,
        905744,
        906238,
        906259,
        908435,
        903066,
        904706,
        904719,
        903037,
        908306,
        906443,
        906444,
        906750,
        902029,
        902120,
        906447,
        906448,
        906325,
        906239,
        903038,
        903039,
        903040,
        903041,
        903859,
        903860,
        906912,
        905750,
        903065,
        905003,
        905408,
        906847,
        906841,
        902031,
        904510,
        904108,
        904109,
        904204,
        902032,
        905752,
        907103,
        902034,
        906913,
        906914,
        903048,
        903049,
        902037,
        902036,
        903042,
        904710,
        903861,
        903862,
        903863,
        906486,
        903433,
        902063,
        903043,
        902121,
        911022,
        901501,
        901403,
        901404,
        901406,
        902038,
        908307,
        903887,
        903894,
        902217,
        901407,
        905753,
        907104,
        902218,
        902219,
        902220,
        902221,
        902224,
        902222,
        902223,
        907106,
        904003,
        902039,
        902041,
        906453,
        906454,
        906326,
        906327,
        906241,
        906242,
        906243,
        906244,
        906139,
        905756,
        906328,
        907009,
        907008,
        906245,
        903044,
        906455,
        906916,
        906915,
        903434,
        903435,
        901319,
        906456,
        903864,
        903865,
        904708,
        901320,
        901321,
        901322,
        902122,
        905759,
        905503,
        905760,
        905607,
        904601,
        904602,
        902042,
        902043,
        902044,
        902045,
        902046,
        902047,
        902048,
        902049,
        906503,
        906517,
        904920,
        906457,
        906458,
        906460,
        906461,
        906463,
        906465,
        908317,
        908113,
        908114,
        906491,
        904921,
        904922,
        902225,
        905409,
        906125,
        906845,
        906846,
        908820,
        906126,
        906127,
        906128,
        906129,
        903867,
        903866,
        903045,
        903046,
        906477,
        906478,
        906479,
        906039,
        906040,
        906041,
        903868,
        906132,
        906131,
        903047,
        904923,
        904924,
        904925,
        902066,
        903438,
        903439,
        898203,
        903869,
        907107,
        907010,
        907011,
        907108,
        901235,
        901236,
        901237,
        905410,
        905411,
        911026,
        906247,
        906248,
        906249,
        906840,
        906250,
        906251,
        908802,
        906329,
        906253,
        903701,
        903702,
        903703,
        903704,
        903705,
        903709,
        903707,
        903706,
        903708,
        903711,
        905102,
        905103,
        901238,
        903608,
        903609,

    ];
    const COLORS = [
        'Tubo amarillo',
        'Tubo azul',
        'FCO Hemocultivo',
        'Tubo lila',
        'Diferentes muestras',
        'Líquido amniótico',
        'Materia fecal',
        'Orina'
    ];

    const CODES_AMARILLO = [
        905701,
        905702,
        906469,
        906401,
        903105,
        903110,
        903111,
        908347,
        908002,
        903112,
        906601,
        903801,
        905201,
        905202,
        903101,
        908701,
        906203,
        904709,
        906901,
        903803,
        903402,
        904801,
        903403,
        903404,
        903405,
        903406,
        903407,
        903001,
        906602,
        903050,
        903611,
        905403,
        903805,
        908103,
        908104,
        908105,
        908106,
        903602,
        904803,
        904501,
        904001,
        906521,
        906522,
        906903,
        906406,
        905303,
        905304,
        906001,
        906002,
        906603,
        906604,
        906605,
        906606,
        906610,
        906611,
        906612,
        906302,
        906613,
        906614,
        906490,
        906303,
        906304,
        903411,
        903409,
        903412,
        903410,
        906305,
        908703,
        906102,
        905203,
        905204,
        905305,
        905306,
        906480,
        906620,
        908503,
        908704,
        901301,
        903809,
        906103,
        906306,
        901202,
        906004,
        906006,
        906009,
        906008,
        906010,
        901203,
        906012,
        906013,
        905714,
        905715,
        903603,
        903604,
        903810,
        906621,
        906015,
        901241,
        905716,
        905717,
        903812,
        905719,
        905207,
        908340,
        906408,
        906409,
        908406,
        908610,
        903006,
        902101,
        906411,
        906412,
        906413,
        903416,
        903417,
        906018,
        906019,
        906020,
        906021,
        906307,
        906308,
        905414,
        906108,
        906107,
        906109,
        906205,
        906206,
        906414,
        906415,
        906466,
        903813,
        905307,
        905726,
        906111,
        903815,
        903816,
        903817,
        903818,
        903420,
        906805,
        906806,
        906904,
        906905,
        906906,
        906907,
        906908,
        902202,
        902203,
        904805,
        904806,
        904812,
        904813,
        904301,
        904302,
        904303,
        903819,
        903820,
        903821,
        903822,
        903825,
        906909,
        906627,
        906112,
        906314,
        903054,
        903827,
        903423,
        904809,
        904808,
        906207,
        906208,
        906209,
        903011,
        903424,
        903828,
        903829,
        905601,
        905602,
        905603,
        905605,
        906417,
        906418,
        905727,
        906810,
        906811,
        906471,
        906113,
        906210,
        906212,
        906213,
        906214,
        906215,
        906216,
        906217,
        902106,
        906420,
        904503,
        904401,
        905729,
        904504,
        904505,
        904506,
        905208,
        904101,
        906813,
        906910,
        906911,
        905308,
        903202,
        908315,
        905210,
        905213,
        905214,
        905216,
        903016,
        905415,
        903830,
        903831,
        903832,
        903833,
        903834,
        903017,
        906422,
        906423,
        903835,
        903837,
        903425,
        903301,
        908302,
        903838,
        906116,
        906624,
        905404,
        905405,
        906475,
        904901,
        908323,
        908322,
        902108,
        902109,
        903841,
        903842,
        903843,
        903844,
        903845,
        904508,
        906625,
        907006,
        903020,
        903021,
        906022,
        906023,
        906024,
        906025,
        906218,
        906219,
        906224,
        906262,
        906220,
        906221,
        906222,
        906223,
        906317,
        906318,
        906818,
        906225,
        906227,
        906226,
        906319,
        906228,
        906229,
        906230,
        906231,
        906320,
        908413,
        905723,
        904811,
        904402,
        904509,
        902116,
        903846,
        908606,
        908607,
        906501,
        906502,
        906504,
        906505,
        906506,
        906424,
        906118,
        906507,
        906508,
        906509,
        906510,
        904103,
        904511,
        904104,
        904205,
        904206,
        904202,
        904201,
        904902,
        904903,
        904904,
        904905,
        904906,
        904105,
        904106,
        904203,
        904107,
        906467,
        904911,
        904912,
        904913,
        904914,
        906232,
        906233,
        906824,
        906825,
        906826,
        906827,
        906833,
        906834,
        906835,
        906836,
        906828,
        906829,
        906831,
        906832,
        906837,
        904704,
        904705,
        904702,
        906425,
        906426,
        904703,
        901402,
        903605,
        906429,
        906430,
        903024,
        906028,
        901311,
        903430,
        903847,
        903431,
        901312,
        905312,
        905313,
        903854,
        906431,
        905504,
        906484,
        906432,
        906433,
        906434,
        906436,
        906437,
        906438,
        906439,
        906032,
        906036,
        906323,
        903856,
        905001,
        906440,
        906441,
        906442,
        903432,
        903034,
        903035,
        906238,
        906259,
        904706,
        904719,
        906447,
        906239,
        903859,
        906912,
        903065,
        906841,
        904510,
        904108,
        904109,
        904204,
        902032,
        906913,
        906914,
        903048,
        903049,
        903042,
        904710,
        903861,
        903863,
        906486,
        911022,
        901501,
        901403,
        903887,
        903894,
        902041,
        906453,
        906454,
        906241,
        906242,
        906243,
        906244,
        906139,
        906245,
        903044,
        906455,
        906916,
        906915,
        903434,
        901319,
        906456,
        903864,
        901320,
        901321,
        901322,
        904601,
        904602,
        904920,
        906457,
        906458,
        906460,
        906461,
        906463,
        906465,
        906491,
        904921,
        904922,
        905409,
        906125,
        906845,
        906846,
        908820,
        906126,
        906127,
        906128,
        906129,
        903867,
        903866,
        903045,
        903046,
        906477,
        906478,
        906479,
        906039,
        906040,
        906041,
        903868,
        906132,
        906131,
        904923,
        904924,
        904925,
        903438,
        903439,
        898203,
        903869,
        905410,
        905411,
        906247,
        906248,
        906249,
        906250,
        906251,
        906253,
        903701,
        903703,
        903709,
        903707,
        903706,
        903708,
        903711,
        903608,
        906823,
        905102,
        905103,
        908350,
        905003,
        903047,
        905301,
        905302,
        903823,
    ];

    const CODES_AZUL = [
        908609,
        902004,
        902005,
        902006,
        902007,
        902008,
        902009,
        902051,
        902064,
        902010,
        902011,
        902104,
        902105,
        902012,
        902014,
        902016,
        902017,
        902018,
        902019,
        902020,
        902021,
        902022,
        902023,
        906814,
        902024,
        902059,
        902027,
        902119,
        902029,
        902120,
        902031,
        902034,
        902037,
        902036,
        902063,
        902039,
        902042,
        902043,
        902044,
        902045,
        902046,
        902047,
        902048,
        902049,
    ];

    const DIFRENTES_MUESTRAS = [
        901201,
        901001,
        901002,
        901003,
        898003,
        898101,
        898102,
        908809,
        903004,
        903005,
        898006,
        898001 - 2,
        898001,
        901104,
        901103,
        901107,
        901101,
        901108,
        901109,
        901207,
        901208,
        901209,
        906701,
        901211,
        901212,
        901213,
        901214,
        901215,
        901218,
        901216,
        901217,
        901219,
        898201,
        898241,
        907201,
        903013,
        898004,
        898008,
        898110,
        908423,
        908422,
        908424,
        908421,
        908418,
        908420,
        901304,
        901305,
        907005,
        903839,
        901220,
        901221,
        901222,
        901223,
        901224,
        901225,
        901004,
        906119,
        901228,
        903848,
        903501,
        903502,
        903849,
        903850,
        903503,
        903851,
        903852,
        903853,
        903504,
        905730,
        901229,
        907202,
        901230,
        901231,
        901232,
        901233,
        901317,
        901234,
        898112,
        907007,
        906325,
        903043,
        902219,
        906329,
    ];

    const ORINA = [
        903103,
        903104,
        903107,
        903109,
        903802,
        903113,
        908001,
        908343,
        903804,
        905704,
        904802,
        903806,
        908338,
        908101,
        904502,
        903808,
        905718,
        908202,
        908203,
        904804,
        898002,
        905310,
        903875,
        903836,
        903840,
        903428,
        904814,
        906322,
        903855,
        903879,
        903025,
        903059,
        903026,
        903027,
        903028,
        903031,
        903857,
        905740,
        903033,
        903036,
        903037,
        903038,
        903040,
        903041,
        903860,
        907103,
        903862,
        905753,
        907104,
        907106,
        905756,
        903435,
        903865,
        905759,
        905760,
        907107,
        907010,
        907011,
        907108,
        901235,
        901236,
        901237,
        903609,
        903811,
        903007,
        903009,
        903052,
        903053,
        903814,
        903880,
        905725,
        903421,
        903422,
        904807,
        903824,
        903826,
        906807,
        906812,
        906337,
        908109,
        908113,
        905711,
        905709,
        905731,
    ];

    const CODES_LILA = [
        903106,
        908812,
        902053,
        902002,
        902003,
        905705,
        905706,
        905707,
        905708,
        911004,
        911005,
        908702,
        908433,
        908404,
        908405,
        908407,
        908408,
        908410,
        908409,
        908411,
        903008,
        903010,
        905721,
        905502,
        903419,
        911008,
        902201,
        906844,
        908412,
        906808,
        906809,
        908811,
        902204,
        902205,
        905505,
        902206,
        908427,
        908441,
        902015,
        911013,
        902107,
        902211,
        911016,
        902212,
        911018,
        902213,
        902110,
        902111,
        902112,
        903426,
        903427,
        902113,
        902114,
        902207,
        902208,
        902209,
        902210,
        902115,
        902214,
        902215,
        906815,
        908833,
        906817,
        908428,
        906711,
        906722,
        906724,
        906725,
        906730,
        906736,
        906717,
        906716,
        906738,
        906718,
        906719,
        906763,
        906712,
        906713,
        906714,
        906715,
        906720,
        906721,
        906764,
        906744,
        902117,
        902118,
        903067,
        908426,
        905741,
        903066,
        906443,
        906444,
        906750,
        903039,
        903433,
        902121,
        902218,
        902220,
        902221,
        902224,
        902222,
        902223,
        904708,
        905503,
        906503,
        906517,
        902225,
        906840,
        908802,
        903702,
        903704,
        903705,
        911020,
        905736,
        905801,
        903401,
    ];

    const LIQUIDO_AMNIOTICO = [
        903002
    ];

    const MATERIA_FECAL = [
        908201,
        907001,
        906851,
        901502,
        901102,
        901206,
        907002,
        907003,
        907004,
        901303,
        901313,
        906327,
        907009,
        907008,
    ];

    const CUP_TYPE = ['Laboratorio'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->generateColors();
        $this->generateCupsType();
        $this->updateCodes();
    }

    private function generateColors()
    {
        for ($i = 0; $i < count(self::COLORS); $i++) {
            $color = Color::where('color', '=', self::COLORS[$i])->first();
            if ($color) continue;
            Color::create(['color' => self::COLORS[$i]]);
        }
    }

    private function generateCupsType()
    {
        for ($i = 0; $i < count(self::CUP_TYPE); $i++) {
            $cup_name = self::CUP_TYPE[$i];
            $cups_type = Cup_type::where('name', '=', $cup_name)->first();
            if ($cups_type) continue;
            Cup_type::create([
                'name' => $cup_name
            ]);
        }
    }

    private function updateCodes()
    {
        $cups = Cup::all();
        foreach ($cups as $cup) {
            $cup->update(['color_id' => null]);
        }
        $cup->update(['color_id' => null]);
        for ($i = 0; $i < count(self::CODES); $i++) {
            $code = self::CODES[$i];
            $cup = Cup::where('code', '=', $code)->first();
            if (!$cup) continue;
            $cup->cup_type_id = Cup_type::inRandomOrder()->first()->id;
            $cup->save();
        }
        for ($i = 0; $i < count(self::CODES_AMARILLO); $i++) {
            $code = self::CODES_AMARILLO[$i];
            $cup = Cup::where('code', '=', $code)->first();
            if (!$cup) continue;
            $cup->color_id = Color::where('color', 'Tubo amarillo')->first()->id;
            $cup->save();
        }
        for ($i = 0; $i < count(self::CODES_AZUL); $i++) {
            $code = self::CODES_AZUL[$i];
            $cup = Cup::where('code', '=', $code)->first();
            if (!$cup) continue;
            $cup->color_id = Color::where('color', 'Tubo azul')->first()->id;
            $cup->save();
        }
        for ($i = 0; $i < count(self::DIFRENTES_MUESTRAS); $i++) {
            $code = self::DIFRENTES_MUESTRAS[$i];
            $cup = Cup::where('code', '=', $code)->first();
            if (!$cup) continue;
            $cup->color_id = Color::where('color', 'Diferentes muestras')->first()->id;
            $cup->save();
        }
        for ($i = 0; $i < count(self::ORINA); $i++) {
            $code = self::ORINA[$i];
            $cup = Cup::where('code', '=', $code)->first();
            if (!$cup) continue;
            $cup->color_id = Color::where('color', 'Orina')->first()->id;
            $cup->save();
        }
        for ($i = 0; $i < count(self::CODES_LILA); $i++) {
            $code = self::CODES_LILA[$i];
            $cup = Cup::where('code', '=', $code)->first();
            if (!$cup) continue;
            $cup->color_id = Color::where('color', 'Tubo lila')->first()->id;
            $cup->save();
        }
        for ($i = 0; $i < count(self::LIQUIDO_AMNIOTICO); $i++) {
            $code = self::LIQUIDO_AMNIOTICO[$i];
            $cup = Cup::where('code', '=', $code)->first();
            if (!$cup) continue;
            $cup->color_id = Color::where('color', 'Líquido amniótico')->first()->id;
            $cup->save();
        }
        for ($i = 0; $i < count(self::MATERIA_FECAL); $i++) {
            $code = self::MATERIA_FECAL[$i];
            $cup = Cup::where('code', '=', $code)->first();
            if (!$cup) continue;
            $cup->color_id = Color::where('color', 'Materia fecal')->first()->id;
            $cup->save();
        }
    }
}
